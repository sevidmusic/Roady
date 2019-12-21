<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Classifiable;
use DarlingCms\abstractions\primary\Exportable;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends ClassifiableTest
{
    use ExportableTestTrait;
    /**
     * @var Exportable|MockObject
     */
    protected $exportable;

    /**
     * @var Classifiable|Exportable|MockObject
     */
    protected $classifiable;

    public function setUp(): void
    {
        $constructorArguments = [];
        $this->exportable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Exportable', $constructorArguments);
        $this->classifiable = $this->exportable;
    }

}

