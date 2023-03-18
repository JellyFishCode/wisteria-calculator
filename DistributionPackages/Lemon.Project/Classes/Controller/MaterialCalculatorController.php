<?php

namespace Lemon\Project\Controller;

/*
 * This file is part of the Lemon.Project package.
 */

use Lemon\Project\Domain\Model\ContributionPointsEntry;
use Lemon\Project\Domain\Model\GuildGrade;
use Lemon\Project\Domain\Model\Material;
use Lemon\Project\Domain\Model\MaterialAmount;
use Lemon\Project\Domain\Repository\GuildGradeRepository;
use Lemon\Project\Domain\Repository\MaterialAmountRepository;
use Lemon\Project\Domain\Repository\MaterialRepository;
use Lemon\Project\Domain\Repository\ContributionPointsEntryRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Visol\Cacheable\Annotations as Cacheable;
use Visol\Cacheable\Annotations\Method;

class MaterialCalculatorController extends AbstractRouteController
{
    #[Flow\Inject]
    protected ContributionPointsEntryRepository $contributionPointsEntryRepository;

    #[Flow\Inject]
    protected MaterialRepository $materialRepository;

    #[Flow\Inject]
    protected GuildGradeRepository $guildGradeRepository;

    #[Flow\Inject]
    protected MaterialAmountRepository $materialAmountRepository;

    public function indexAction(): void
    {
        $guildGrades = $this->getGuildGradeValues();
        $contributionPointsEntries = $this->contributionPointsEntryRepository->findAll();
        $totalAvailableContributionPoints = 0;
        foreach ($contributionPointsEntries as $contributionPointsEntry) {
            /** @var ContributionPointsEntry $contributionPointsEntry */
            $totalAvailableContributionPoints += $contributionPointsEntry->getTotalContributionPoints();
        }

        $this->view->assignMultiple([
            'entries' => $this->contributionPointsEntryRepository->findAll(),
            'totalAvailableContributionPoints' => $totalAvailableContributionPoints,
            'guildGrades' => $guildGrades
        ]);
    }

    public function calculatorAction(ContributionPointsEntry $contributionPointsEntry = null
    ): void {
        $materials = $this->materialRepository->findAll();
        if ($contributionPointsEntry) {
            $materials = [];
            foreach ($this->materialRepository->findAll() as $material) {
                $materialAmountObject = $this->materialAmountRepository->findByContributionPointsEntryAndMaterial(
                    $contributionPointsEntry,
                    $material
                )->getFirst();

                $materialAmount = 0;
                /** @var MaterialAmount $materialAmountObject */
                if (isset($materialAmountObject) && $materialAmountObject->getAmount() !== 0) {
                    $materialAmount = $materialAmountObject->getAmount();
                }

                /** @var Material $material */
                $materials[] = [
                    'name' => $material->getName(),
                    'contributionPointsValue' => $material->getContributionPointsValue(),
                    'amount' => $materialAmount
                ];
            }
        }
        $this->view->assignMultiple([
            'contributionPointsEntry' => $contributionPointsEntry,
            'materials' => $materials,
        ]);
    }

    public function createOrUpdateAction()
    {
        $materials = $this->request->getArgument('materialArray');
        $contributionPointsEntryObject = $this->request->getArgument('contributionPointsEntry');
        $contributionPointsEntry = new ContributionPointsEntry();

        $updateExistingObject = false;
        if ($contributionPointsEntryObject['__identity'] ?? false) {
            $updateExistingObject = true;
            $contributionPointsEntry = $this->contributionPointsEntryRepository->findByIdentifier(
                $contributionPointsEntryObject['__identity']
            );
        }
        $contributionPointsEntry->setName($contributionPointsEntryObject['name']);


        $totalPoints = 0;
        foreach ($materials as $materialName => $amount) {
            /** @var Material $material */
            $material = $this->materialRepository->findOneByName($materialName);
            if ($amount === '') {
                $amount = 0;
            }

            $updateMaterialAmount = false;
            $materialAmount = new MaterialAmount();

            if ($updateExistingObject) {
                $materialAmount = $this->materialAmountRepository->findByContributionPointsEntryAndMaterial(
                    $contributionPointsEntry,
                    $material
                )->getFirst();

                $updateMaterialAmount = true;
                if (!$materialAmount) {
                    $updateMaterialAmount = false;
                    $materialAmount = new MaterialAmount();
                }
            }

            $materialAmount->setAmount($amount);
            $materialAmount->setMaterial($material);
            $materialAmount->setContributionPointsEntry($contributionPointsEntry);

            $totalPoints += ($amount * $material->getContributionPointsValue());

            if ($updateMaterialAmount) {
                $this->materialAmountRepository->update($materialAmount);
                continue;
            }
            $this->materialAmountRepository->add($materialAmount);
        }

        if ($totalPoints === 0) {
            $this->persistenceManager->clearState();
            $this->addFlashMessage('No contribution points set');
            $this->redirect('index');
        }

        $contributionPointsEntry->setTotalContributionPoints($totalPoints);

        if ($updateExistingObject) {
            $this->contributionPointsEntryRepository->update($contributionPointsEntry);
            $this->persistenceManager->persistAll();
            $this->addFlashMessage(sprintf('Updated entry from %s!', $contributionPointsEntry->getName()));
            $this->redirect('index');
        }

        $this->contributionPointsEntryRepository->add($contributionPointsEntry);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage('Created a new entry.');
        $this->redirect('index');
    }

    public function deleteAction(ContributionPointsEntry $contributionPointsEntry)
    {
        $this->contributionPointsEntryRepository->remove($contributionPointsEntry);
        $this->addFlashMessage('Deleted a entry.');
        $this->redirect('index');
    }

    /**
     * @Cacheable\Method(lifetime=1800, cacheIdentifier=Method::CACHE_PERSISTENT)
     */
    protected function getGuildGradeValues(): array
    {
        $guildGradeArray = $this->guildGradeRepository->findAll()->toArray();
        usort($guildGradeArray, function ($a, $b) {
            return $b->getSortablePosition() - $a->getSortablePosition();
        });

        $guildGradeArrays = [];
        foreach ($guildGradeArray as $guildGrade) {
            /** @var GuildGrade $guildGrade */
            $formattedGuildGradeArray = [];
            $formattedGuildGradeArray['name'] = $guildGrade->getName();
            $neededContributionPoints = $guildGrade->getNeededContributionPoints();
            $formattedGuildGradeArray['neededContributionPoints'] = $neededContributionPoints;
            $formattedGuildGradeArray['fallbackLevels'] = $guildGrade->getFallbackLevels();

            $fallbackGuildGrade = $this->guildGradeRepository->findOneBySortablePosition(
                $guildGrade->getSortablePosition() - $guildGrade->getFallbackLevels()
            );
            $neededContributionPointsForFallbackGuildGrade = $fallbackGuildGrade->getNeededContributionPoints();

            $weeklyContributionPoints = $neededContributionPoints - $neededContributionPointsForFallbackGuildGrade;
            $formattedGuildGradeArray['weeklyContributionPointsInTotal'] = $weeklyContributionPoints;
            $formattedGuildGradeArray['weeklyContributionPointsPerPlayer'] = (int)(1000 * ceil(
                    $weeklyContributionPoints / 30 / 1000
                ));

            $guildGradeArrays[] = $formattedGuildGradeArray;
        }

        return $guildGradeArrays;
    }
}
