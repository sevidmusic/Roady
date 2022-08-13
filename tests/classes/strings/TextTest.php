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
     */
    use TextTestTrait;

    /**
     * Set up a Text instance for testing using a randomly
     * generated string.
     *
     * Note:This method will be called before each test is run.
     *
     * @return void
     *
     * @see https://phpunit.readthedocs.io/en/9.5/fixtures.html
     *
     */
    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($string);
        $this->setTextTestInstance(new Text($string));
    }

}
