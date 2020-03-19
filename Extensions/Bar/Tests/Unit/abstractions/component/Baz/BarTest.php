<?php

namespace Extensions\Bar\Tests\Unit\abstractions\component\Baz;

use DarlingCms\classes\primary\Storable;
use Extensions\Bar\Tests\Unit\interfaces\component\Baz\TestTraits\BarTestTrait;
use UnitTests\abstractions\component\ComponentTest as BaseComponentTest;

class BarTest extends BaseComponentTest
{
    use BarTestTrait;

    public function setUp(): void
    {
        $this->setBar(
            $this->getMockForAbstractClass(
                '\Extensions\Bar\core\abstractions\component\Baz\Bar',
                [
                    new Storable(
                        'MockBarName',
                        'MockBarLocation',
                        'MockBarContainer'
                    ),
                ]
            )
        );
        $this->setBarParentTestInstances();
    }

}
