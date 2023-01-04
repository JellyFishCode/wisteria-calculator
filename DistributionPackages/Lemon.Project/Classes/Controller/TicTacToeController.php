<?php

namespace Lemon\Project\Controller;

use Lemon\Project\Domain\Model\TurnCounter;
use Lemon\Project\Service\TicTacToeService;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Lemon\Project\Domain\Model\TicTacToe;

class TicTacToeController extends ActionController
{
    /**
     * @Flow\Inject
     * @var \Lemon\Project\Domain\Repository\TicTacToeRepository
     */
    protected $ticTacToeRepository;

    /**
     * @Flow\Inject
     * @var \Lemon\Project\Domain\Repository\TurnCounterRepository
     */
    protected $turnCounterRepository;

    /**
     * @Flow\Inject
     * @var TicTacToeService
     */
    protected $ticTacToeService;

    public function indexAction(int $roundResult = 10): void
    {
        $arr = $this->ticTacToeRepository->findAll()->toArray();
        sort($arr);
        $this->view->assign('ticTacToes', $arr);

        /** @var TurnCounter $turnCounter */
        $turnCounter = $this->turnCounterRepository->findAll()->getFirst();
        $this->view->assign('turnCount', $turnCounter->getTurnCount());
        $this->view->assign('roundResult', $roundResult);
    }

    public function clickFieldAction(TicTacToe $tic): void
    {
        /** @var TurnCounter $turnCounter */
        $turnCounter = $this->turnCounterRepository->findAll()->getFirst();

        if($turnCounter->getTurnCount() % 2 === 0){
            $tic->setFieldValue(1);
        } else {
            $tic->setFieldValue(0);
        }
        $this->ticTacToeRepository->update($tic);

        $turnCounter->increaseTurn();
        $this->turnCounterRepository->update($turnCounter);

        if($this->ticTacToeService->checkWinningCondition() >= 0){
            $winner = $this->ticTacToeService->checkWinningCondition(); //TODO: check & assign does not work
            $this->redirect(actionName: 'index', arguments: ['roundResult' => $winner]);
        }

        if($turnCounter->getTurnCount() === 10){
            $this->redirect(actionName: 'index', arguments: ['roundResult' => -1]);
        }

        $this->redirect('index');
    }

    public function restartAction(): void
    {
        $this->ticTacToeRepository->removeAll();

        for ($i = 1; $i <= 9; $i++) {
            $tic = new TicTacToe($i);
            $this->ticTacToeRepository->add($tic);
        }
        $this->turnCounterRepository->removeAll();
        $this->turnCounterRepository->add(new TurnCounter(1));

        $this->redirect('index');
    }

    public function backAction(): void
    {
        $this->redirect('index', 'standard');
    }

}
