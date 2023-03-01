<?php

namespace Lemon\Project\Command;

use Lemon\Project\Domain\Model\TicTacToe;
use Lemon\Project\Domain\Model\TurnCounter;
use Lemon\Project\Domain\Repository\TicTacToeRepository;
use Lemon\Project\Domain\Repository\TurnCounterRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

class TicTacToeCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var TicTacToeRepository
     */
    protected TicTacToeRepository $ticTacToeRepository;

    /**
     * @Flow\Inject
     * @var TurnCounterRepository
     */
    protected TurnCounterRepository $turnCounterRepository;

    /**
     * @Flow\InjectConfiguration
     * @var array
     */
    protected array $settings;

    /**
     * tictactoe:initiateBoard
     * Command which needs to be initiated before playing TicTacToe
     *
     * Creates 9 Tics and a TurnCounter
     *
     */
    public function initiateBoardCommand(): void
    {
        $this->ticTacToeRepository->removeAll();

        for ($i = 1; $i <= 9; $i++) {
            $tic = new TicTacToe($i);
            $this->ticTacToeRepository->add($tic);
        }
        $this->turnCounterRepository->removeAll();
        $this->turnCounterRepository->add(new TurnCounter(1));

        $this->outputLine('Created ' . count($this->ticTacToeRepository->findAll()) . ' Tics and Reset Counter to '.
        count($this->turnCounterRepository->findAll()));
    }
}
