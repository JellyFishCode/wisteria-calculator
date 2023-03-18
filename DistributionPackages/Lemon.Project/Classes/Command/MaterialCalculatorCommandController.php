<?php

namespace Lemon\Project\Command;

use Lemon\Project\Domain\Repository\MaterialAmountRepository;
use Lemon\Project\Domain\Repository\MaterialRepository;
use Lemon\Project\Domain\Repository\ContributionPointsEntryRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

class MaterialCalculatorCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var MaterialRepository
     */
    protected MaterialRepository $materialRepository;

    /**
     * @Flow\Inject
     * @var ContributionPointsEntryRepository
     */
    protected ContributionPointsEntryRepository $contributionPointsEntryRepository;

    /**
     * @Flow\Inject
     * @var MaterialAmountRepository
     */
    protected MaterialAmountRepository $materialAmountRepository;

    /**
     * @Flow\InjectConfiguration
     * @var array
     */
    protected array $settings;

    public function clearCommand(): void
    {
        $this->materialRepository->removeAll();
        $this->contributionPointsEntryRepository->removeAll();
        $this->materialAmountRepository->removeall();
    }

    public function testCommand(): void
    {
        print_r($this->settings);
    }
}
