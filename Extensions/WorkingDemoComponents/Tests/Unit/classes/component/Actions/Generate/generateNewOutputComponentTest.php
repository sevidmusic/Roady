<?php

namespace Extensions\WorkingDemoComponents\Tests\Unit\classes\component\Actions\Generate;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use Extensions\WorkingDemoComponents\core\classes\component\Actions\Generate\generateNewOutputComponent;
use Extensions\WorkingDemoComponents\Tests\Unit\abstractions\component\Actions\Generate\generateNewOutputComponentTest as AbstractgenerateNewOutputComponentTest;

class generateNewOutputComponentTest extends AbstractgenerateNewOutputComponentTest
{
    public function setUp(): void
    {
        $this->setgenerateNewOutputComponent(
            new generateNewOutputComponent(
                new Storable(
                    'generateNewOutputComponentName',
                    'generateNewOutputComponentLocation',
                    'generateNewOutputComponentContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setgenerateNewOutputComponentParentTestInstances();
    }
}
