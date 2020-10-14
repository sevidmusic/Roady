<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingDataManagementSystem\interfaces\primary\Identifiable as IdentifiableInterface;
use UnitTests\TestTraits\StringTester;

trait IdentifiableTestTrait
{

    use StringTester;

    private IdentifiableInterface $identifiable;

    public function testGetNameReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getIdentifiable()->getName());
    }

    protected function getIdentifiable(): IdentifiableInterface
    {
        return $this->identifiable;
    }

    protected function setIdentifiable(IdentifiableInterface $identifiable): void
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
