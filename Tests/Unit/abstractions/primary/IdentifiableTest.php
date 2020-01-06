<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\IdentifiableTestTrait;

class IdentifiableTest extends TestCase
{
    use IdentifiableTestTrait;

    public function setUp(): void
    {
        $this->setIdentifiable(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\Identifiable',
                ['MockName']
            )
        );
    }

}

