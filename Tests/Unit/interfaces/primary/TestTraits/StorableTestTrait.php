<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Storable;
use UnitTests\TestTraits\StringTester;

trait StorableTestTrait
{

    use StringTester;

    /**
     * @var Storable
     */
    private $storable;

    public function setStorable(Storable $storable)
    {
        $this->storable = $storable;
    }

    public function getStorable(): Storable
    {
        return $this->storable;
    }

    /** @noinspection PhpUnused */
    public function testGetLocationReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getLocation());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getLocation());
    }

    /** @noinspection PhpUnused */
    public function testGetContainerReturnsNonEmptyAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getStorable()->getContainer());
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getStorable()->getContainer());
    }
}
