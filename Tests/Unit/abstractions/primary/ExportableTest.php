<?php

namespace UnitTests\abstractions\primary;

use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends ClassifiableTest
{
    use ExportableTestTrait;

    public function setUp(): void
    {
        $constructorArguments = [];
        $this->setExportable($this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Exportable', $constructorArguments));
        $this->setClassifiable($this->getExportable());
    }

}

