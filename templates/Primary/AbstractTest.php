<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\DS_COMPONENT_NAMETestTrait;

class DS_COMPONENT_NAMETest extends TestCase
{
    use DS_COMPONENT_NAMETestTrait;

    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\DS_COMPONENT_NAME',
            )
        );
    }

}

