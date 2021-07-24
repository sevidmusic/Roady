<?php

namespace UnitTests\classes\utility;

use roady\classes\utility\ReflectionUtility;
use roady\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use UnitTests\abstractions\utility\ReflectionUtilityTest as AbstractReflectionUtilityTest;

class ReflectionUtilityTest extends AbstractReflectionUtilityTest implements ReflectionUtilityInterface
{
    public function setUp(): void
    {
        $this->setReflectionUtility(new ReflectionUtility());
    }

}

