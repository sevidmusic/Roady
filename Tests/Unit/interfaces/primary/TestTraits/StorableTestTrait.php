<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

trait StorableTestTrait
{

    use IdentifiableTestTrait;

    private StorableInterface $storable;

    public function testGetLocationReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getLocation());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getLocation());
    }

    protected function getStorable(): StorableInterface
    {
        return $this->storable;
    }

    protected function setStorable(StorableInterface $storable)
    {
        $this->storable = $storable;
    }

    public function testGetContainerReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getContainer());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getContainer());
    }
}
