<?php

namespace UnitTests\classes\primary;

use roady\classes\primary\Classifiable;
use UnitTests\abstractions\primary\ClassifiableTest as AbstractClassifiableTest;

class ClassifiableTest extends AbstractClassifiableTest
{

    public function setUp(): void
    {
        $this->setClassifiable(new Classifiable());
    }

}

