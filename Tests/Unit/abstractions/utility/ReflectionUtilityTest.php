<?php

namespace UnitTests\abstractions\utility;

use DarlingCms\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use DarlingCms\abstractions\utility\ReflectionUtility;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\utility\TestTraits\ReflectionUtilityTestTrait;

class ReflectionUtilityTest extends TestCase implements ReflectionUtilityInterface {
    use ReflectionUtilityTestTrait;
   protected $reflectionUtility;

    public function setUp():void {
        $this->reflectionUtility = $this->getMockForAbstractClass('\DarlingCms\abstractions\utility\ReflectionUtility');;
    }

}

