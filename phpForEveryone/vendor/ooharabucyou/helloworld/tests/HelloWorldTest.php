<?php

namespace Ooharabucyou\HelloWorld\Test;

use Ooharabucyou\HelloWorld\HelloWorld;
use PHPUnit\Framework\TestCase;

/**
 * Class HelloWorldTest
 * @package Ooharabucyou\HelloWorld\Test
 */
class HelloWorldTest extends TestCase
{
    public function testSay()
    {
        $target = new HelloWorld('PHPer');
        $this->assertSame('Hello, PHPer!', $target->say());
    }
}
