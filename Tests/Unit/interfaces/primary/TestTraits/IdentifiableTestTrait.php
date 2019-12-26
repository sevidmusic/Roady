<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Identifiable;
use UnitTests\TestTraits\StringTester;

trait IdentifiableTestTrait
{

    use StringTester;

    /**
     * @var Identifiable
     */
    private $identifiable;

    public function getIdentifiable()
    {
        return $this->identifiable;
    }

    public function setIdentifiable(Identifiable $identifiable)
    {
        $this->identifiable = $identifiable;
    }

    /** @noinspection PhpUnused */
    public function testGetNameReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getIdentifiable()->getName());
    }

    /** @noinspection PhpUnused */
    public function testGetNameReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getIdentifiable()->getName());
    }

    /** @noinspection PhpUnused */
    public function testGetUniqueIdReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getIdentifiable()->getUniqueId());
    }

    /** @noinspection PhpUnused */
    public function testGetUniqueIdReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric($this->getIdentifiable()->getUniqueId());
    }

}
