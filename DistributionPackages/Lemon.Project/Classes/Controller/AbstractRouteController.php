<?php
namespace Lemon\Project\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

abstract class AbstractRouteController extends ActionController
{
    public function backAction()
    {
        $this->redirect('index', 'standard');
    }

}
