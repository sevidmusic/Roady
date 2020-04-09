<?php

namespace Extensions\WorkingDemoComponents\Tests\Unit\abstractions\component\Actions\Generate;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\ActionTest as CoreActionTest;
use Extensions\WorkingDemoComponents\core\abstractions\component\Actions\Generate\generateNewOutputComponent;
use Extensions\WorkingDemoComponents\Tests\Unit\interfaces\component\Actions\Generate\TestTraits\generateNewOutputComponentTestTrait;

class generateNewOutputComponentTest extends CoreActionTest
{
    use generateNewOutputComponentTestTrait;

    public function setUp(): void
    {
        $this->setgenerateNewOutputComponent(
            $this->getMockForAbstractClass(
                '\Extensions\WorkingDemoComponents\core\abstractions\component\Actions\Generate\generateNewOutputComponent',
                [
                    new Storable(
                        'MockgenerateNewOutputComponentName',
                        'MockgenerateNewOutputComponentLocation',
                        'MockgenerateNewOutputComponentContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setgenerateNewOutputComponentParentTestInstances();
    }

}
