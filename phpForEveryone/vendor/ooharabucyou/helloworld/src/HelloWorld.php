<?php

namespace Ooharabucyou\HelloWorld;

/**
 * Class HelloWorld
 * @package Ooharabucyou\HelloWorld
 */
class HelloWorld
{
    /**
     * @var string $name Your name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Say hello
     */
    public function say()
    {
        return 'Hello, ' . $this->name . '!';
    }
}
