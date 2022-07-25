<?php

namespace tests\classes\strings;

use tests\interfaces\strings\TextTestTrait;
use roady\classes\strings\Text;
use PHPUnit\Framework\TestCase;

/**
 * Defines tests for the `roady\classes\strings\Text` implementation
 * of the `roady\interfaces\strings\Text` interface.
 *
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
        try {
            $string = random_bytes(rand(100, 1000));
        } catch(\Exception $e) {
            $chars = 'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
            $string = str_shuffle($chars);
        }
        $this->setExpectedString($string);
        $this->setTestInstance(new Text($string));
    }

}
