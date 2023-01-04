<?php
namespace Lemon\Project\Domain\Model;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class TicTacToe
{

    /**
     * @var int
     */
    protected $fieldId;

    /**
     * 1 == hypercube at the moment X
     * 0 == trapezohedron at the moment O
     * -1 == unset
     * @var int
     */
    protected int $fieldValue = -1;


    function __construct(int $fieldId)
    {
        $this->fieldId = $fieldId;
    }

    public function getFieldId(): int
    {
        return $this->fieldId;
    }

    public function getFieldValue(): int
    {
        return $this->fieldValue;
    }

    /**
     * @param int $fieldValue
     */
    public function setFieldValue(int $fieldValue): void
    {
        $this->fieldValue = $fieldValue;
    }
}
