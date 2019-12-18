<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Exportable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends TestCase {
   use ExportableTestTrait;
   protected $exportable;

    public function setUp():void {
        $this->exportable = new \DarlingCms\classes\primary\Exportable('MockName');
    }

}

