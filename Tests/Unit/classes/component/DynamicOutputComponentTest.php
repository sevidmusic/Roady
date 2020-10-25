<?php

namespace UnitTests\classes\component;

use DarlingDataManagementSystem\classes\component\DynamicOutputComponent as CoreDynamicOutputComponent;
use UnitTests\abstractions\component\DynamicOutputComponentTest as DynamicOutputCompoenentBaseTest;

class DynamicOutputComponentTest extends DynamicOutputCompoenentBaseTest
{
    public function setUp(): void
    {
        $this->setDynamicOutputComponent(
            new CoreDynamicOutputComponent(
                ...$this->getDynamicOutputComponentTestArgs()
            )
        );
        $this->setDynamicOutputComponentParentTestInstances();
    }
}
