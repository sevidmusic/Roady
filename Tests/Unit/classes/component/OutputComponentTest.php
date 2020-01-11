<?php

namespace UnitTests\classes\component;

use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as AbstractOutputComponentTest;

class OutputComponentTest extends AbstractOutputComponentTest
{
    public function setUp(): void
    {
        $this->setOutputComponent(
            new OutputComponent(
                new Storable(
                    'OutputComponentName',
                    'OutputComponentLocation',
                    'OutputComponentContainer'
                ),
                new Switchable()
            )
        );
        $this->setOutputComponentParentTestInstances();
    }
}
