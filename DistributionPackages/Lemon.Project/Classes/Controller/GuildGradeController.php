<?php
namespace Lemon\Project\Controller;

/*
 * This file is part of the Lemon.Project package.
 */

use Lemon\Project\Domain\Model\GuildGrade;
use Lemon\Project\Domain\Model\Material;
use Lemon\Project\Domain\Repository\GuildGradeRepository;
use Monolog\Logger;
use Neos\Flow\Annotations as Flow;

class GuildGradeController extends AbstractRouteController
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
