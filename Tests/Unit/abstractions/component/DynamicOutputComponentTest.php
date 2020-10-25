<?php

namespace UnitTests\abstractions\component;

use UnitTests\abstractions\component\OutputComponentTest as OutputComponentBaseTest;
use DarlingDataManagementSystem\abstractions\component\DynamicOutputComponent as DynamicOutputComponentBase;
use UnitTests\interfaces\component\TestTraits\DynamicOutputComponentTestTrait as DynamicOutputComponentTests;

class DynamicOutputComponentTest extends OutputComponentBaseTest
{
    use DynamicOutputComponentTests;

    public function setUp(): void
    {
        $this->setDynamicOutputComponent(
            $this->getMockForAbstractClass(
                DynamicOutputComponentBase::class,
                $this->getDynamicOutputComponentTestArgs()
            )
        );
        $this->setDynamicOutputComponentParentTestInstances();
    }

}
