<?php

namespace Lemon\Project\Service;

use Neos\Flow\Annotations as Flow;
use Lemon\Project\Domain\Model\TicTacToe;
use Neos\Flow\Persistence\Doctrine\PersistenceManager;
use Neos\Flow\Persistence\PersistenceManagerInterface;

/**
 * add Singleton
 */
class TicTacToeService
{
    /**
     * @Flow\Inject
     * @var \Lemon\Project\Domain\Repository\TicTacToeRepository
     */
    protected $ticTacToeRepository;

    public function checkWinningCondition(): int
    {
        $winningLines = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
            [1, 4, 7],
            [2, 5, 8],
            [3, 6, 9],
            [1, 5, 9],
            [3, 5, 7],
        ];
        $allTics = $this->ticTacToeRepository->findAll();
        $arrWithFieldIdAndFieldValue = [];
        foreach ($allTics as $ticTacToe) {
            $arrWithFieldIdAndFieldValue[$ticTacToe->getFieldId()] = $ticTacToe->getFieldValue();
        }

        foreach ($winningLines as $winningLine) {
            $result = array_intersect_key($arrWithFieldIdAndFieldValue, array_flip($winningLine));
            if (count(array_unique($result)) === 1) {
                return reset($result);
            }
        }

        return -10;
    }


}
