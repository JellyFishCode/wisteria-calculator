<?php

namespace Wisteria\Wisteria\Command;



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
