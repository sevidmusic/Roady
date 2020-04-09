<?php

namespace Extensions\ComponentManager\Tests\Unit\classes\component\Actions\Create;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use Extensions\ComponentManager\core\classes\component\Actions\Create\CreateOutputComponent;
use Extensions\ComponentManager\Tests\Unit\abstractions\component\Actions\Create\CreateOutputComponentTest as AbstractCreateOutputComponentTest;

class CreateOutputComponentTest extends AbstractCreateOutputComponentTest
{
    public function setUp(): void
    {
        $this->setCreateOutputComponent(
            new CreateOutputComponent(
                new Storable(
                    'CreateOutputComponentName',
                    'CreateOutputComponentLocation',
                    'CreateOutputComponentContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setCreateOutputComponentParentTestInstances();
    }
}
