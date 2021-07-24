<?php

namespace UnitTests\abstractions\component\Web;

use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use UnitTests\interfaces\component\Web\TestTraits\AppTestTrait;

class AppTest extends CoreSwitchableComponentTest
{
    use AppTestTrait;

    public function setUp(): void
    {
        $this->setApp(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Web\App',
                [
                    $this->getMockRequest(),
                    new Switchable(),
                ]
            )
        );
        $this->setAppParentTestInstances();
    }
}
