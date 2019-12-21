<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Classifiable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\ClassifiableTestTrait;

class ClassifiableTest extends TestCase
{
    use ClassifiableTestTrait;

    /**
     * @var Classifiable|MockObject
     */
    protected $classifiable;

    public function setUp(): void
    {
        $constructorArguments = [];
        $this->classifiable = $this->getMockForAbstractClass('\DarlingCms\classes\primary\Classifiable', $constructorArguments);
    }

}

