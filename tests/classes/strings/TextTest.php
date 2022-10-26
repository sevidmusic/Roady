<?php

namespace tests\classes\strings;

use roady\classes\strings\Text;
use tests\RoadyTestCase;
use tests\interfaces\strings\TextTestTrait;

class TextTest extends RoadyTestCase
{

    /**
     * The TextTestTrait defines common tests for implementations of
     * the roady\interfaces\strings\Text interface.
     *
     * @see TextTestTrait
     */
    use TextTestTrait;


    /**
     * Default setup using a randomly generated string.
     *
     * @return void
     *
     */
    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($string);
        $this->setTextTestInstance(new Text($string));
    }

}
