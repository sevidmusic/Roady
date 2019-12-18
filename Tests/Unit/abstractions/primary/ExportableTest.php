<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Exportable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends TestCase {
    use ExportableTestTrait;
   protected $exportable;

    public function setUp():void {
        $constructorArguments = [];
        $this->exportable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Exportable', $constructorArguments);
    }

}

