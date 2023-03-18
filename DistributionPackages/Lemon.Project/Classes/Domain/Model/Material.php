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
class Material
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $contributionPointsValue;

    /**
     * @ORM\OneToMany(mappedBy="material")
     *
     * @var Collection<MaterialAmount>
     * @Flow\Lazy
     */
    protected $materialAmounts;

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

    public function __construct()
    {
        $this->materialAmounts = new ArrayCollection();
    }

    public function getName(): string
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

    public function getContributionPointsValue(): int
    {
        return $this->contributionPointsValue;
    }

    public function setContributionPointsValue(int $contributionPointsValue): void
    {
        $this->contributionPointsValue = $contributionPointsValue;
    }

    public function getContributionPointsEntry(): ContributionPointsEntry
    {
        return $this->contributionPointsEntry;
    }

    public function setContributionPointsEntry(ContributionPointsEntry $contributionPointsEntry): void
    {
        $this->contributionPointsEntry = $contributionPointsEntry;
    }

    public function getSortablePosition(): int
    {
        return $this->sortablePosition;
    }

    public function setSortablePosition(int $sortablePosition): void
    {
        $this->sortablePosition = $sortablePosition;
    }


}
