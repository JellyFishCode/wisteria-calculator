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
class Note
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var DateTime
     * @Gedmo\Timestampable(on="create")
     */
    protected DateTime $createdDateTime;

    /**
     * @ORM\Column(nullable=true)
     *
     * @var DateTime
     * @Gedmo\Timestampable(on="update")
     */
    protected DateTime $updatedDateTime;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $comment;

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

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}
