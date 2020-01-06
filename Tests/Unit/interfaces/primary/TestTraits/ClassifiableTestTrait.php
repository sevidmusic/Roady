<?php

/** @noinspection PhpUnused */

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Classifiable;
use UnitTests\TestTraits\StringTester;

trait ClassifiableTestTrait
{
    use StringTester;

    private $classifiable;


    protected function getClassifiable(): Classifiable
    {
        return $this->classifiable;
    }

    protected function setClassifiable(Classifiable $classifiable): void
    {
        $this->classifiable = $classifiable;
    }

    public function testGetTypeReturnsNonEmptyString()
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getClassifiable()->getType());
    }

    public function testGetTypeReturnsInstancesFullyQualifiedClassName()
    {
        $this->getStringTestUtility()->stringsMatch(
            $this->getClassifiable()->getType(),
            get_class($this->getClassifiable())
        );
    }

}
