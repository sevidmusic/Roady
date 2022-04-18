<?php

namespace UnitTests\abstractions\component;

use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
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
                '\roady\abstractions\component\OutputComponent',
                [
                    new Storable(
                        'AbstractOutputComponentTestMockOutputComponentName',
                        'AbstractOutputComponentTestMockOutputComponentLocation',
                        'AbstractOutputComponentTestMockOutputComponentContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setOutputComponentParentTestInstances();
    }
}
