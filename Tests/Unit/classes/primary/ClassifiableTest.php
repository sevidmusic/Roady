<?php

namespace UnitTests\classes\primary;

use DarlingDataManagementSystem\classes\primary\Classifiable;
use UnitTests\abstractions\primary\ClassifiableTest as AbstractClassifiableTest;

class ClassifiableTest extends AbstractClassifiableTest
{

    public function setUp(): void
    {
        $this->setClassifiable(new Classifiable());
    }

}

