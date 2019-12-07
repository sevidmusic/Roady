<?php

namespace UnitTests\abstractions\utility;

use DarlingCms\abstractions\utility\ReflectionUtility;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\utility\TestTraits\ReflectionUtilityTestTrait;

class ReflectionUtilityTest extends TestCase {
    use ReflectionUtilityTestTrait;
   protected $reflectionUtility;

    public function setUp():void {
        $this->reflectionUtility = $this->getMockForAbstractClass('\DarlingCms\abstractions\utility\ReflectionUtility');;
    }

}

