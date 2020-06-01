<?php

namespace UnitTests\classes\component\Web;

use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\primary\Switchable;
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
