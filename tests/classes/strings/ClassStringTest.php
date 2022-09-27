<?php

namespace tests\classes\strings;

use roady\classes\strings\ClassString;
use roady\classes\strings\Text as TextToBeRepresentedByClassString;
use roady\interfaces\strings\Text as Text;
use tests\classes\strings\TextTest;
use tests\interfaces\strings\ClassStringTestTrait;

class ClassStringTest extends TextTest
{

    /**
     * The ClassStringTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\ClassString interface.
     *
     * @see ClassStringTestTrait
     *
     */
    use ClassStringTestTrait;

    /**
     * Default setup a random string, class-string, or object
     * instance.
     *
     * @return void
     *
     */
    protected function setUp(): void
    {
        $values = [
            $this->randomChars(),
            $this,
            ClassString::class,
            'foo',
        ];
        $this->setUpWithSpecifiedClass(
            $values[array_rand($values)]
        );
    }

    /**
     * Setup using a specified class or object instance.
     *
     * @return void
     */
    protected function setUpWithSpecifiedClass(
        object|string $classString
        ): void
    {
        $classString = new ClassString($classString);
        $this->setTextTestInstance($classString);
        $this->setClassStringTestInstance($classString);
        $this->setExpectedString($classString);
    }
}

