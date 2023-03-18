<?php
namespace Wisteria\Wisteria\Controller;

/*
 * This file is part of the Wisteria.Wisteria package.
 */

use Wisteria\Wisteria\Domain\Model\GuildGrade;
use Wisteria\Wisteria\Domain\Model\Material;
use Wisteria\Wisteria\Domain\Repository\GuildGradeRepository;
use Monolog\Logger;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class GuildGradeController extends ActionController
{
    #[Flow\Inject]
    protected GuildGradeRepository $guildGradeRepository;

    public function indexAction(): void
    {
        $guildGradeArray = $this->guildGradeRepository->findAll()->toArray();
        usort($guildGradeArray, function($a, $b){
            return $b->getSortablePosition() - $a->getSortablePosition();
        });
        $this->view->assign('guildGrades', $guildGradeArray);
    }
    public function createAction(GuildGrade $guildGrade)
    {
        $this->guildGradeRepository->add($guildGrade);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage('Created a new GuildGrade!');
        $this->redirect('index');
    }
}
