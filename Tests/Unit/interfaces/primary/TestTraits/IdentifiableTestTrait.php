<?php

namespace UnitTests\interfaces\primary\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait IdentifiableTestTrait {

    protected static $stringTestUtility;

    /**
     * @beforeClass
     */
    public static function initializeStringTestUtility() {
        self::$stringTestUtility = new StringTestUtility();
    }

    public function testGetNameReturnsNonEmptyString() {
        self::$stringTestUtility->stringIsNotEmpty($this->identifiable->getName());
    }

    public function testGetNameReturnsAlphaNumericString() {
        self::$stringTestUtility->stringIsAlphaNumeric($this->identifiable->getName());
    }

    public function testGetUniqueIdReturnsNonEmptyString() {
        self::$stringTestUtility->stringIsNotEmpty($this->identifiable->getUniqueId());
    }

    public function testGetUniqueIdReturnsAlphaNumericString() {
        self::$stringTestUtility->stringIsAlphaNumeric($this->identifiable->getUniqueId());
    }

}
