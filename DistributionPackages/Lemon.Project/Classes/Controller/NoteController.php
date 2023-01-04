<?php
namespace Lemon\Project\Controller;

/*
 * This file is part of the Lemon.Project package.
 */

use Neos\Flow\Annotations as Flow;
use Lemon\Project\Domain\Model\Note;

class NoteController extends AbstractRouteController
{

    /**
     * @Flow\Inject
     * @var \Lemon\Project\Domain\Repository\NoteRepository
     */
    protected $noteRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('notes', $this->noteRepository->findAll());
        return;
        echo 'asef';
    }

    /**
     * @param \Lemon\Project\Domain\Model\Note $note
     * @return void
     */
    public function showAction(Note $note)
    {
        $this->view->assign('note', $note);
    }

    /**
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * @param \Lemon\Project\Domain\Model\Note $newNote
     * @return void
     */
    public function createAction(Note $newNote)
    {
        $this->noteRepository->add($newNote);
        $this->addFlashMessage('Created a new note.');
        $this->redirect('index');
    }

    /**
     * @param \Lemon\Project\Domain\Model\Note $note
     * @return void
     */
    public function editAction(Note $note)
    {
        $this->view->assign('note', $note);
    }

    /**
     * @param \Lemon\Project\Domain\Model\Note $note
     * @return void
     */
    public function updateAction(Note $note)
    {
        $this->noteRepository->update($note);
        $this->addFlashMessage('Updated the note.');
        $this->redirect('index');
    }

    /**
     * @param \Lemon\Project\Domain\Model\Note $note
     * @return void
     */
    public function deleteAction(Note $note)
    {
        $this->noteRepository->remove($note);
        $this->addFlashMessage('Deleted a note.');
        $this->redirect('index');
    }
}
