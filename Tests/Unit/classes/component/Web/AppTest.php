<?php

namespace UnitTests\classes\component\Web;

use roady\classes\component\Web\App;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\AppTest as AbstractAppTest;

class AppTest extends AbstractAppTest
{
    public function setUp(): void
    {
        $this->setApp(
            new App(
                $this->getMockRequest(),
                new Switchable(),
            )
        );
        $this->setAppParentTestInstances();
    }
}
