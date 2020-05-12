<?php

namespace UnitTests\abstractions\component\Web;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use UnitTests\interfaces\component\Web\TestTraits\AppTestTrait;

class AppTest extends CoreSwitchableComponentTest
{
    use AppTestTrait;

    public function setUp(): void
    {
        $this->setApp(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Web\App',
                [
                    new Storable(
                        'MockAppName',
                        'MockAppLocation',
                        'MockAppContainer'
                    ),
                    new Switchable(),
                ]
            )
        );
        $this->setAppParentTestInstances();
    }
}