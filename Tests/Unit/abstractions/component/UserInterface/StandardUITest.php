<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

class StandardUITest extends CoreOutputComponentTest
{
    use StandardUITestTrait;

    public function setUp(): void
    {
        $this->setStandardUI(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\UserInterface\StandardUI',
                [
                    new Storable(
                        'MockStandardUIName',
                        'MockStandardUILocation',
                        'MockStandardUIContainer'
                    ),
                    new Switchable(),
                    new Positionable(),
                    new Router(
                        new Storable('StandardUI_AbstractTestRouter', 'StandardUI_TestComponents', 'StandardUI_TestRouters'),
                        new Switchable(),
                        $this->getCurrentRequest(),
                        $this->getCrud()
                    )
                ]
            )
        );
        $this->setStandardUIParentTestInstances();
    }

}
