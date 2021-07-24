<?php

namespace UnitTests\classes\component;

use roady\classes\component\OutputComponent;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as AbstractOutputComponentTest;

class OutputComponentTest extends AbstractOutputComponentTest
{
    public function setUp(): void
    {
        $this->setOutputComponent(
            new OutputComponent(
                new Storable(
                    'OutputComponentName',
                    'OutputComponentLocation',
                    'OutputComponentContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setOutputComponentParentTestInstances();
    }
}
