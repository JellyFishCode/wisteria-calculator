<?php
namespace Lemon\Project\Domain\Model;

/*
 * This file is part of the Lemon.Project package.
 */

use DateTime;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Flow\Entity
 */
class ContributionPointsEntry
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $totalContributionPoints = 0;

    /**
     * @var DateTime
     * @Gedmo\Timestampable(on="create")
     */
    protected DateTime $createdAt;

    /**
     * @ORM\Column(nullable=true)
     *
     * @var DateTime
     * @Gedmo\Timestampable(on="update")
     */
    protected DateTime $updatedAt;

    /**
     * @ORM\Column(nullable=true)
     *
     * @var int
     * @Gedmo\SortablePosition
     */
    protected int $sortablePosition;

    /**
     * @ORM\OneToMany(mappedBy="contributionPointsEntry", cascade={"persist","remove"})
     *
     * @var Collection<MaterialAmount>
     * @Flow\Lazy
     */
    protected $materialAmounts;

    public function __construct()
    {
        $this->materialAmounts = new ArrayCollection();
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getTotalContributionPoints(): int
    {
        return $this->totalContributionPoints;
    }

    public function setTotalContributionPoints(int $totalContributionPoints): void
    {
        $this->totalContributionPoints = $totalContributionPoints;
    }

    public function getMaterialAmounts(): ?Collection
    {
        return $this->materialAmounts;
    }

    public function setMaterialAmounts(Collection $materialAmounts): void
    {
        $this->materialAmounts = $materialAmounts;
    }


}
