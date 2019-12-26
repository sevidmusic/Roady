<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Identifiable;
use UnitTests\abstractions\primary\IdentifiableTest as AbstractIdentifiableTest;

class IdentifiableTest extends AbstractIdentifiableTest
{
    public function setUp(): void
    {
        $this->setIdentifiable(new Identifiable('MockName'));
    }

}

