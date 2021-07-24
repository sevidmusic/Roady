<?php

namespace UnitTests\interfaces\primary\TestTraits;

use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use UnitTests\TestTraits\StringTester;

trait ClassifiableTestTrait
{
    use StringTester;

    private ClassifiableInterface $classifiable;

    public function testGetTypeReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getClassifiable()->getType());
    }

    protected function getClassifiable(): ClassifiableInterface
    {
        return $this->classifiable;
    }

    protected function setClassifiable(ClassifiableInterface $classifiable): void
    {
        $this->classifiable = $classifiable;
    }

    public function testGetTypeReturnsInstancesFullyQualifiedClassName(): void
    {
        $this->getStringTestUtility()->stringsMatch(
            $this->getClassifiable()->getType(),
            get_class($this->getClassifiable())
        );
    }

}
