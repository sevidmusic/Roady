<?php

namespace UnitTests\classes\primary;

use roady\classes\primary\Identifiable;
use UnitTests\abstractions\primary\IdentifiableTest as IdentifiableTestBase;

class IdentifiableTest extends IdentifiableTestBase
{
    public function setUp(): void
    {
        $this->setIdentifiable(
            new Identifiable($this->getRandomTestName())
        );
    }

}

