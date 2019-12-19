<?php

namespace UnitTests\interfaces\primary\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait StorableTestTrait {
    protected static $stringTestUtility;

    /**
     * @beforeClass
     */
    public static function initializeStringTestUtility() {
        self::$stringTestUtility = new StringTestUtility();
    }

    public function testGetLocationReturnsNonEmptyAlphaNumericString() {
        self::$stringTestUtility->stringIsNotEmpty($this->storable->getLocation());
        self::$stringTestUtility->stringIsAlphaNumeric($this->storable->getLocation());
    }

    public function testGetContainerReturnsNonEmptyAlphaNumericString() {
        self::$stringTestUtility->stringIsNotEmpty($this->storable->getContainer());
        self::$stringTestUtility->stringIsAlphaNumeric($this->storable->getContainer());
    }
}
