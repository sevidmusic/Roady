<?php

namespace UnitTests\abstractions\utility;

use roady\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\utility\TestTraits\ReflectionUtilityTestTrait;

class ReflectionUtilityTest extends TestCase implements ReflectionUtilityInterface
{
    use ReflectionUtilityTestTrait;

    public function setUp(): void
    {
        $this->setReflectionUtility(
            $this->getMockForAbstractClass(
                '\roady\abstractions\utility\ReflectionUtility'
            )
        );
    }

}

