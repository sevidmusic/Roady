<?php

/** @noinspection PhpUnused */

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Classifiable;
use UnitTests\TestTraits\StringTester;

trait ClassifiableTestTrait
{
    use StringTester;

    /**
     * @var Classifiable
     */
    private $classifiable;


    public function getClassifiable(): Classifiable
    {
        return $this->classifiable;
    }

    public function setClassifiable(Classifiable $classifiable): void
    {
        $this->classifiable = $classifiable;
    }

    public function testGetTypeReturnsNonEmptyString()
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getClassifiable()->getType());
    }

}
