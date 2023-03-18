<?php

namespace Lemon\Project\Command;



use Lemon\Project\Factory\LemonDriver;
use Lemon\Project\Service\TicTacToeService;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

class TestCommandController extends CommandController
{

   /**
     * @Flow\InjectConfiguration
     * @var array
     */
    protected array $settings;

    public function testCommand(): void
    {
        echo 'test';
    }
}
