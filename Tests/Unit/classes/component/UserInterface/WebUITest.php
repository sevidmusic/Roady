<?php

namespace UnitTests\classes\component\UserInterface;

use roady\classes\component\UserInterface\WebUI as CoreWebUI;
use UnitTests\abstractions\component\UserInterface\WebUITest as WebUITestBase;

class WebUITest extends WebUITestBase
{
    public function setUp(): void
    {
        $this->setWebUI(
            new CoreWebUI(
                ...$this->getWebUITestArgs()
            )
        );
        $this->setWebUIParentTestInstances();
    }
}
