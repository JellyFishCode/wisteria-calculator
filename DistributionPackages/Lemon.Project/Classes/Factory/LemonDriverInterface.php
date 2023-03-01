<?php

namespace Lemon\Project\Factory;

use Neos\Flow\Annotations as Flow;

interface LemonDriverInterface
{
    public function get(string $identifier, string $secondArgument);
}
