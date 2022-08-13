<?php

namespace tests\classes\strings;

use PHPUnit\Framework\TestCase;
use roady\classes\strings\Text;
use tests\interfaces\strings\TextTestTrait;

class TextTest extends TestCase
{

    /**
     * The TextTestTrait defines common tests for implementations of
     * the Text interface.
     *
     * @see TextTestTrait
     *
     */
    use TextTestTrait;

    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($string);
        $this->setTextTestInstance(new Text($string));
    }

}
