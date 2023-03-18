<?php
namespace Lemon\Project\Domain\Model;

/*
 * This file is part of the Lemon.Project package.
 */

use DateTime;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Flow\Entity
 */
class MaterialAmount
{


    /**
     * @var int
     */
    protected $amount;

    /**
     * @ORM\ManyToOne(inversedBy="materialAmounts")
     *
     * @var Material
     * @Flow\Lazy
     */
    protected $material;

    /**
     * @ORM\ManyToOne(inversedBy="materialAmounts", cascade={"remove"})
     *
     * @var ContributionPointsEntry
     * @Flow\Lazy
     */
    protected $contributionPointsEntry;

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getMaterial(): Material
    {
        return $this->material;
    }

    public function setMaterial(Material $material): void
    {
        $this->material = $material;
    }

    public function getContributionPointsEntry(): ContributionPointsEntry
    {
        return $this->contributionPointsEntry;
    }

    public function setContributionPointsEntry(ContributionPointsEntry $contributionPointsEntry): void
    {
        $this->contributionPointsEntry = $contributionPointsEntry;
    }


}
