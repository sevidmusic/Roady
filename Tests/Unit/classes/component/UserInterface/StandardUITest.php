<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\UserInterface\StandardUITest as AbstractStandardUITest;

class StandardUITest extends AbstractStandardUITest
{
    public function setUp(): void
    {
        $this->setStandardUI(
            new StandardUI(
                new Storable(
                    'StandardUIName',
                    'StandardUILocation',
                    'StandardUIContainer'
                ),
                new Switchable(),
                new Positionable(),
                new Router(
                    new Storable('StandardUI_AbstractTestRouter', 'StandardUI_TestComponents', 'StandardUI_TestRouters'),
                    new Switchable(),
                    $this->getCurrentRequest(),
                    $this->getCrud()
                )
            )
        );
        $this->setStandardUIParentTestInstances();
    }
}
