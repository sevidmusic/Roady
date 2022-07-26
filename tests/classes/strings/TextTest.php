<?php

namespace tests\classes\strings;

use tests\interfaces\strings\TextTestTrait;
use roady\classes\strings\Text;
use PHPUnit\Framework\TestCase;

/**
 * Defines tests for the `roady\classes\strings\Text` implementation
 * of the `roady\interfaces\strings\Text` interface.
 *
 * @see TestCase
 * @see Text
 * @see TextTestTrait
 *
 */
class TextTest extends TestCase
{

    use TextTestTrait;

    /**
     * Set up a Text instance for testing using a randomly
     * generated string.
     *
     * @return void
     */
    public function setup(): void
    {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-=+';
        try {
            $string .= random_bytes(rand(100, 1000));
        } catch(\Exception $e) {
        }
        $string = str_shuffle($string);
        $this->setExpectedString($string);
        $this->setTestInstance(new Text($string));
    }

}
