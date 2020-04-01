<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingCms\abstractions\component\UserInterface\StandardUI;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;

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
                    new Positionable()
                ]
            )
        );
        $this->setStandardUIParentTestInstances();
    }

}
