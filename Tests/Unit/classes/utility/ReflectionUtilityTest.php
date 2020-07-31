<?php

namespace UnitTests\classes\utility;

use DarlingDataManagementSystem\classes\utility\ReflectionUtility;
use DarlingDataManagementSystem\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use UnitTests\abstractions\utility\ReflectionUtilityTest as AbstractReflectionUtilityTest;

class ReflectionUtilityTest extends AbstractReflectionUtilityTest implements ReflectionUtilityInterface
{
    public function setUp(): void
    {
        $this->setReflectionUtility(new ReflectionUtility());
    }

}

