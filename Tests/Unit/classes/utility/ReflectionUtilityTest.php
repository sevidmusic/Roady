<?php

namespace UnitTests\classes\utility;

use DarlingCms\classes\utility\ReflectionUtility;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\utility\TestTraits\ReflectionUtilityTestTrait;

class ReflectionUtilityTest extends TestCase {
    use ReflectionUtilityTestTrait;
   protected $reflectionUtility;

    public function setUp():void {
        $this->reflectionUtility = new \DarlingCms\classes\utility\ReflectionUtility();
    }

}

