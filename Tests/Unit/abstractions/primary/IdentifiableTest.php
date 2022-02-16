<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\IdentifiableTestTrait;
use roady\abstractions\primary\Identifiable;

class IdentifiableTest extends TestCase
{
    use IdentifiableTestTrait;

    public function setUp(): void
    {
        $this->setIdentifiable(
            $this->getMockForAbstractClass(
                Identifiable::class,
                [$this->getRandomTestName()]
            )
        );
    }

}

