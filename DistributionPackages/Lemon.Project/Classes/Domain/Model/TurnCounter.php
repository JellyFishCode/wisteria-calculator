<?php

namespace Lemon\Project\Domain\Model;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class TurnCounter
{

    /**
     * @var int
     */
    protected $turnCount;

    function __construct(int $turnCount)
    {
        $this->turnCount = $turnCount;
    }

    public function getTurnCount(): int
    {
        return $this->turnCount;
    }

    public function increaseTurn(): void
    {
        $this->turnCount++;
    }

    public function resetTurn(): void
    {
        $this->turnCount = 1;
    }
}
