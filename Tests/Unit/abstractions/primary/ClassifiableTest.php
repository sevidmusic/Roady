<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\ClassifiableTestTrait;

class ClassifiableTest extends TestCase
{
    use ClassifiableTestTrait;

    public function setUp(): void
    {
        $this->setClassifiable(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\Classifiable'
            )
        );
    }

}

