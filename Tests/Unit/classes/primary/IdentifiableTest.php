<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Identifiable;

class IdentifiableTest extends \UnitTests\abstractions\primary\IdentifiableTest
{
    public function setUp(): void
    {
        $this->identifiable = new Identifiable('MockName');
    }

}

