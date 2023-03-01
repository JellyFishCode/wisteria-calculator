<?php

namespace Lemon\Project\Factory;

use Neos\Flow\Annotations as Flow;

class LemonDriver implements LemonDriverInterface
{
    /**
     * @var array
     */
    protected $configuration = [];

    /**
     * @var string
     */
    protected $someValue = 'asdfasdf';

    public function __construct(array $configuration = [])
    {
        $this->configuration = $configuration;
    }

    public function get(string $identifier, string $secondArgument): LemonDriver
    {
        //echo 'get command from LemonDriver is called';
        echo $identifier. ' '. $secondArgument;
        echo PHP_EOL;
        $lemonDriver = new LemonDriver();
        print_r($this->configuration);
        return $lemonDriver;
    }

    /**
     * @return string
     */
    public function getSomeValue(): string
    {
        return $this->someValue;
    }

    /**
     * @param string $someValue
     */
    public function setSomeValue(string $someValue): void
    {
        $this->someValue = $someValue;
    }


}
