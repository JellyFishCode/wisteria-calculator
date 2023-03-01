<?php

namespace Lemon\Project\Command;


use Lemon\Project\Factory\LemonDriver;
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
        $lemon = $this->objectManager->get(LemonDriver::class);

        echo PHP_EOL;
        echo 'test ended';
    }
}
