<?php

namespace UnitTests\abstractions\component;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\primary\ExportableTest;
use UnitTests\interfaces\component\TestTraits\ComponentTestTrait;

class ComponentTest extends ExportableTest
{
    use ComponentTestTrait;

    public function setUp(): void
    {
        $this->setComponent(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Component',
                [
                    new Storable(
                        'MockComponentName',
                        'MockComponentLocation',
                        'MockComponentContainer'
                    )
                ]
            )
        );
        $this->setComponentParentTestInstances();
    }

    protected function setComponentParentTestInstances(): void
    {
        $this->setExportable($this->getComponent());
        $this->setClassifiable($this->getComponent());
        $this->setStorable($this->getComponent());
        $this->setIdentifiable($this->getComponent());
    }
}

