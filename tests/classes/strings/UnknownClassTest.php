<?php

namespace tests\classes\strings;

use roady\classes\strings\UnknownClass;
use tests\classes\strings\ClassStringTest;
use tests\interfaces\strings\UnknownClassTestTrait;

final class UnknownClassTest extends ClassStringTest
{

    /**
     * The UnknownClassTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\UnknownClass interface.
     *
     * @see UnknownClassTestTrait
     *
     */
    use UnknownClassTestTrait;

    protected function setUpWithSpecifiedClass(
        object|string $classString
        ): void
    {
        $classString = new UnknownClass();
        $this->setTextTestInstance($classString);
        $this->setClassStringTestInstance($classString);
        $this->setUnknownClassTestInstance($classString);
        $this->setExpectedString($classString);
    }

}

