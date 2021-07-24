<?php

namespace UnitTests\classes\primary;

use roady\classes\primary\Switchable;
use UnitTests\abstractions\primary\SwitchableTest as AbstractSwitchableTest;

class SwitchableTest extends AbstractSwitchableTest
{

    public function setUp(): void
    {
        $this->setSwitchable(new Switchable());
    }

}

