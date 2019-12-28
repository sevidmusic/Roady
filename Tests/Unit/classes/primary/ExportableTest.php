<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Exportable;
use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends ClassifiableTest
{
    use ExportableTestTrait;

    public function setUp(): void
    {
        $this->setExportable(new Exportable());
        $this->setClassifiable($this->getExportable());
    }

}

