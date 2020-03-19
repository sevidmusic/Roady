<?php

namespace Extensions\Bar\classes\component\Baz;

use DarlingCms\classes\primary\Storable;
use Extensions\Bar\core\classes\component\Baz\Bar;
use Extensions\Bar\Tests\Unit\abstractions\component\Baz\BarTest as AbstractBarTest;

class BarTest extends AbstractBarTest
{
    public function setUp(): void
    {
        $this->setBar(
            new Bar(
                new Storable(
                    'BarName',
                    'BarLocation',
                    'BarContainer'
                ),
            )
        );
        $this->setBarParentTestInstances();
    }
}
