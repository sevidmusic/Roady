<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Identifiable as AbstractIdentifiable;
use DarlingCms\classes\primary\Identifiable as Identifiable;
use UnitTests\TestTraits\StringTester;

trait IdentifiableTestTrait
{

    use StringTester;

    /**
     * @var AbstractIdentifiable|Identifiable
     */
    protected $identifiable;

    /** @noinspection PhpUnused */
    public function testGetNameReturnsNonEmptyString(): void
    {
        self::$stringTestUtility->stringIsNotEmpty($this->identifiable->getName());
    }

    /** @noinspection PhpUnused */
    public function testGetNameReturnsAlphaNumericString(): void
    {
        self::$stringTestUtility->stringIsAlphaNumeric($this->identifiable->getName());
    }

    /** @noinspection PhpUnused */
    public function testGetUniqueIdReturnsNonEmptyString(): void
    {
        self::$stringTestUtility->stringIsNotEmpty($this->identifiable->getUniqueId());
    }

    /** @noinspection PhpUnused */
    public function testGetUniqueIdReturnsAlphaNumericString(): void
    {
        self::$stringTestUtility->stringIsAlphaNumeric($this->identifiable->getUniqueId());
    }

}
