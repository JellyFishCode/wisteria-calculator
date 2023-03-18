<?php
namespace Lemon\Project\Controller;

/*
 * This file is part of the Lemon.Project package.
 */

use Lemon\Project\Domain\Model\Material;
use Lemon\Project\Domain\Repository\MaterialRepository;
use Monolog\Logger;
use Neos\Flow\Annotations as Flow;

class MaterialController extends AbstractRouteController
{
    #[Flow\Inject]
    protected MaterialRepository $materialRepository;

    public function indexAction(): void
    {
        $materialsArray = $this->materialRepository->findAll()->toArray();
        usort($materialsArray, function($a, $b){
            return $a->getSortablePosition() - $b->getSortablePosition();
        });

        $this->view->assignMultiple([
            'materials' => array_reverse($materialsArray),
            'maxMaterialPositionValue' => $this->materialRepository->findAll()->count() - 1
        ]);
    }

    public function createAction(Material $material)
    {
        $this->materialRepository->add($material);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage('Created a new material.');
        $this->redirect('index');
    }

    public function deleteAction(Material $material)
    {
        $this->materialRepository->remove($material);
        $this->addFlashMessage('Deleted a material.');
        $this->redirect('index', 'matsCalculator');
    }

    public function decreasePositionAction(Material $material): void
    {
        $materialPosition = $material->getSortablePosition();
        $relatedMaterial = $this->materialRepository->findOneBySortablePosition($materialPosition - 1);
        $material->setSortablePosition(--$materialPosition);
        $relatedMaterial->setSortablePosition(++$materialPosition);

        $this->persistenceManager->allowObject($material);
        $this->materialRepository->update($material);
        $this->persistenceManager->allowObject($relatedMaterial);
        $this->materialRepository->update($relatedMaterial);
        $this->persistenceManager->persistAll();

        $this->redirect('index');
    }

    public function increasePositionAction(Material $material): void
    {
        $materialPosition = $material->getSortablePosition();
        $relatedMaterial = $this->materialRepository->findOneBySortablePosition($materialPosition + 1);
        $material->setSortablePosition(++$materialPosition);
        $relatedMaterial->setSortablePosition(--$materialPosition);

        $this->persistenceManager->allowObject($material);
        $this->materialRepository->update($material);
        $this->persistenceManager->allowObject($relatedMaterial);
        $this->materialRepository->update($relatedMaterial);
        $this->persistenceManager->persistAll();

        $this->redirect('index');
    }
}
