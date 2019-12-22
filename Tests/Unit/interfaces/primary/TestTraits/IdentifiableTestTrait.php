<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Identifiable as AbstractIdentifiable;
use DarlingCms\classes\primary\Identifiable as Identifiable;
use UnitTests\TestUtilities\StringTestUtility;

trait IdentifiableTestTrait
{

    /**
     * @var StringTestUtility
     */
    protected static $stringTestUtility;

    /**
     * @var AbstractIdentifiable|Identifiable
     */
    protected $identifiable;

    /**
     * @beforeClass
     * @noinspection PhpUnused
     */
    public static function initializeStringTestUtility(): void
    {
        self::$stringTestUtility = new StringTestUtility();
    }

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
