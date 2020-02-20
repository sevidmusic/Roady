<?php

namespace UnitTests\abstractions\component;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\TestTraits\OutputComponentTestTrait;
use UnitTests\interfaces\primary\TestTraits\PositionableTestTrait;

class OutputComponentTest extends SwitchableComponentTest
{
    use OutputComponentTestTrait, PositionableTestTrait {
        OutputComponentTestTrait::testGetPositionReturnsGreaterValueAfterCallToIncreasePosition insteadof PositionableTestTrait;
        OutputComponentTestTrait::testDecreasePositionDecreasesPositionByOneHundredth insteadof PositionableTestTrait;
        OutputComponentTestTrait::testGetPositionReturnsLesserValueAfterCallToDecreasePosition insteadof PositionableTestTrait;
        OutputComponentTestTrait::testIncreasePositionIncreasesPositionByOneHundredth insteadof PositionableTestTrait;
    }

    public function setUp(): void
    {
        $this->setOutputComponent(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\OutputComponent',
                [
                    new Storable(
                        'MockOutputComponentName',
                        'MockOutputComponentLocation',
                        'MockOutputComponentContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setPositionable($this->getOutputComponent());
        $this->setOutputComponentParentTestInstances();
    }
}
