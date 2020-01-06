<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Storable;
use UnitTests\TestTraits\StringTester;

trait StorableTestTrait
{

    use StringTester;

    private $storable;

    protected function setStorable(Storable $storable)
    {
        $this->storable = $storable;
    }

    protected function getStorable(): Storable
    {
        return $this->storable;
    }

    public function testGetLocationReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getLocation());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getLocation());
    }

    public function testGetContainerReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getContainer());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getContainer());
    }
}
