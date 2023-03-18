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
class GuildGrade
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $neededContributionPoints = 0;

    /**
     * @var int
     */
    protected $fallbackLevels;



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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getNeededContributionPoints(): int
    {
        return $this->neededContributionPoints;
    }

    public function setNeededContributionPoints(int $neededContributionPoints): void
    {
        $this->neededContributionPoints = $neededContributionPoints;
    }

    public function getFallbackLevels(): int
    {
        return $this->fallbackLevels;
    }

    public function setFallbackLevels(int $fallbackLevels): void
    {
        $this->fallbackLevels = $fallbackLevels;
    }

    /**
     * @return int
     */
    public function getSortablePosition(): int
    {
        return $this->sortablePosition;
    }

    /**
     * @param int $sortablePosition
     */
    public function setSortablePosition(int $sortablePosition): void
    {
        $this->sortablePosition = $sortablePosition;
    }


}
