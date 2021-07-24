<?php

namespace UnitTests\abstractions\component\UserInterface;

use UnitTests\abstractions\component\UserInterface\ResponseUITest as ResponseUITestBase;
use roady\abstractions\component\UserInterface\WebUI as WebUIBase;
use UnitTests\interfaces\component\UserInterface\TestTraits\WebUITestTrait as WebUITestInterface;
use UnitTests\interfaces\component\UserInterface\TestTraits\ResponseUITestTrait as ResponseUITestInterface;

class WebUITest extends ResponseUITestBase
{
    use ResponseUITestInterface, WebUITestInterface {
        WebUITestInterface::expectedOutput insteadof ResponseUITestInterface;
        WebUITestInterface::getRequest insteadof ResponseUITestInterface;
    }

    public function setUp(): void
    {
        $this->setWebUI(
            $this->getMockForAbstractClass(
                WebUIBase::class,
                $this->getWebUITestArgs()
            )
        );
        $this->setWebUIParentTestInstances();
    }

}
