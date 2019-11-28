<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Classifiable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\ClassifiableTestTrait;

class ClassifiableTest extends TestCase {
    use ClassifiableTestTrait;
   protected $classifiable;

    public function setUp():void {
        $constructorArguments = ['MockName'];
        $this->classifiable = $this->getMockForAbstractClass('\DarlingCms\classes\primary\Classifiable', $constructorArguments);
    }

}

