<?php

namespace UnitTests\abstractions\primary;

use UnitTests\interfaces\primary\TestTraits\ExportableTestTrait;

class ExportableTest extends ClassifiableTest
{
    use ExportableTestTrait;

    public function setUp(): void
    {
        $this->setExportable(
            $this->getMockForAbstractClass(
                '\roady\abstractions\primary\Exportable'
            )
        );
        $this->setClassifiable($this->getExportable());
    }

}

