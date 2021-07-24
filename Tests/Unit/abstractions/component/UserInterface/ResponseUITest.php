<?php

namespace UnitTests\abstractions\component\UserInterface;

use UnitTests\abstractions\component\OutputComponentTest as OutputComponentTestBase;
use roady\abstractions\component\UserInterface\ResponseUI as ResponseUIBase;
use UnitTests\interfaces\component\UserInterface\TestTraits\ResponseUITestTrait as ResponseUITestInterface;

class ResponseUITest extends OutputComponentTestBase
{
    use ResponseUITestInterface;

    public function setUp(): void
    {
        $this->setResponseUI(
            $this->getMockForAbstractClass(
                ResponseUIBase::class,
                $this->getResponseUITestArgs()
            )
        );
        $this->setResponseUIParentTestInstances();
    }

}
