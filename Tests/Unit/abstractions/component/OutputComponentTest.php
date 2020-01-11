<?php

namespace UnitTests\abstractions\component;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\TestTraits\OutputComponentTestTrait;

class OutputComponentTest extends SwitchableComponentTest
{
    use OutputComponentTestTrait;


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
        $this->setOutputComponentParentTestInstances();
    }
}
