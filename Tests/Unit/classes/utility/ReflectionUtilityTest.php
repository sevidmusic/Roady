<?php

namespace UnitTests\classes\utility;

use DarlingCms\classes\utility\ReflectionUtility;
use DarlingCms\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use UnitTests\abstractions\utility\ReflectionUtilityTest as AbstractReflectionUtilityTest;

class ReflectionUtilityTest extends AbstractReflectionUtilityTest implements ReflectionUtilityInterface
{
    public function setUp(): void
    {
        $this->setReflectionUtility(new ReflectionUtility());
    }

}

