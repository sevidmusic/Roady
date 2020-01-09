<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Identifiable;
use UnitTests\TestTraits\StringTester;

trait IdentifiableTestTrait
{

    use StringTester;

    private $identifiable;

    public function testGetNameReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getIdentifiable()->getName());
    }

    protected function getIdentifiable()
    {
        return $this->identifiable;
    }

    protected function setIdentifiable(Identifiable $identifiable)
    {
        $this->identifiable = $identifiable;
    }

    public function testGetNameReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getIdentifiable()->getName());
    }

    public function testGetUniqueIdReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getIdentifiable()->getUniqueId());
    }

    public function testGetUniqueIdReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getIdentifiable()->getUniqueId());
    }

}
