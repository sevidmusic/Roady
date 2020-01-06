<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Exportable;
use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;
use UnitTests\abstractions\primary\ExportableTest as AbstractExportableTest;

class ExportableTest extends AbstractExportableTest
{
    use ExportableTestTrait;

    public function setUp(): void
    {
        $this->setExportable(new Exportable());
        $this->setClassifiable($this->getExportable());
    }

}

