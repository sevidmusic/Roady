<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Classifiable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\ClassifiableTestTrait;

class ClassifiableTest extends TestCase {
    use ClassifiableTestTrait;
   protected $classifiable;

    public function setUp():void {
        $constructorArguments = ['MockType'];
        $this->classifiable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Classifiable', $constructorArguments);
    }

}

