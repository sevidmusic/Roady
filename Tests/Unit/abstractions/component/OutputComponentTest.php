<?php /** @noinspection ALL */

namespace UnitTests\abstractions\component;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
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
                '\DarlingDataManagementSystem\abstractions\component\OutputComponent',
                [
                    new Storable(
                        'MockOutputComponentName',
                        'MockOutputComponentLocation',
                        'MockOutputComponentContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setOutputComponentParentTestInstances();
    }
}
