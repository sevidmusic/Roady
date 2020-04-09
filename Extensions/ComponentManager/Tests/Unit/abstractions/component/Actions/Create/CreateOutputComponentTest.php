<?php

namespace Extensions\ComponentManager\Tests\Unit\abstractions\component\Actions\Create;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\ActionTest as CoreActionTest;
use Extensions\ComponentManager\core\abstractions\component\Actions\Create\CreateOutputComponent;
use Extensions\ComponentManager\Tests\Unit\interfaces\component\Actions\Create\TestTraits\CreateOutputComponentTestTrait;

class CreateOutputComponentTest extends CoreActionTest
{
    use CreateOutputComponentTestTrait;

    public function setUp(): void
    {
        $this->setCreateOutputComponent(
            $this->getMockForAbstractClass(
                '\Extensions\ComponentManager\core\abstractions\component\Actions\Create\CreateOutputComponent',
                [
                    new Storable(
                        'MockCreateOutputComponentName',
                        'MockCreateOutputComponentLocation',
                        'MockCreateOutputComponentContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setCreateOutputComponentParentTestInstances();
    }

}
