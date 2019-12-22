<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Storable as AbstractStorable;
use DarlingCms\abstractions\primary\Storable as Storable;
use UnitTests\TestUtilities\StringTestUtility;

trait StorableTestTrait
{
    /**
     * @var StringTestUtility
     */
    protected static $stringTestUtility;

    /**
     * @var AbstractStorable|Storable
     */
    protected $storable;

    /**
     * @beforeClass
     * @noinspection PhpUnused
     */
    public static function initializeStringTestUtility(): void
    {
        self::$stringTestUtility = new StringTestUtility();
    }

    /** @noinspection PhpUnused */
    public function testGetLocationReturnsNonEmptyAlphaNumericString(): void
    {
        self::$stringTestUtility->stringIsNotEmpty($this->storable->getLocation());
        self::$stringTestUtility->stringIsAlphaNumeric($this->storable->getLocation());
    }

    /** @noinspection PhpUnused */
    public function testGetContainerReturnsNonEmptyAlphaNumericString(): void
    {
        self::$stringTestUtility->stringIsNotEmpty($this->storable->getContainer());
        self::$stringTestUtility->stringIsAlphaNumeric($this->storable->getContainer());
    }
}
