<?php

namespace Extensions\Foo\Tests\Unit\abstractions\component\Bazzer;

use DarlingCms\classes\primary\Storable;
use Extensions\Foo\Tests\Unit\interfaces\component\Bazzer\TestTraits\BarTestTrait;
use UnitTests\abstractions\component\ComponentTest;

class BarTest extends ComponentTest
{
    use BarTestTrait;

    public function setUp(): void
    {
        $this->setBar(
            $this->getMockForAbstractClass(
                '\Extensions\Foo\core\abstractions\component\Bazzer\Bar',
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
