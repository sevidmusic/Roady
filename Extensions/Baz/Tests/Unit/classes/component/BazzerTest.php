<?php

namespace Extensions\Baz\classes\component;

use DarlingCms\classes\primary\Storable;
use Extensions\Baz\core\classes\component\Bazzer;
use Extensions\Baz\Tests\Unit\abstractions\component\BazzerTest as AbstractBazzerTest;

class BazzerTest extends AbstractBazzerTest
{
    public function setUp(): void
    {
        $this->setBazzer(
            new Bazzer(
                new Storable(
                    'BazzerName',
                    'BazzerLocation',
                    'BazzerContainer'
                ),
            )
        );
        $this->setBazzerParentTestInstances();
    }
}
