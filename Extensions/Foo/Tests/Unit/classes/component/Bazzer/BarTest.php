<?php

namespace Extensions\Foo\Tests\Unit\classes\component\Bazzer;

use Extensions\Foo\core\classes\component\Bazzer\Bar;
use DarlingCms\classes\primary\Storable;
use Extensions\Foo\Tests\Unit\abstractions\component\Bazzer\BarTest as AbstractBarTest;

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
