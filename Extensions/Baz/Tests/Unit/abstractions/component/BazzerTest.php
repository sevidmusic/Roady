<?php

namespace Extensions\Baz\Tests\Unit\abstractions\component;

use DarlingCms\classes\primary\Storable;
use Extensions\Baz\Tests\Unit\interfaces\component\TestTraits\BazzerTestTrait;
use UnitTests\abstractions\component\ComponentTest as BaseComponentTest;

class BazzerTest extends BaseComponentTest
{
    use BazzerTestTrait;

    public function setUp(): void
    {
        $this->setBazzer(
            $this->getMockForAbstractClass(
                '\Extensions\Baz\core\abstractions\component\Bazzer',
                [
                    new Storable(
                        'MockBazzerName',
                        'MockBazzerLocation',
                        'MockBazzerContainer'
                    ),
                ]
            )
        );
        $this->setBazzerParentTestInstances();
    }

}
