<?php

namespace UnitTests\interfaces\primary\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait ClassifiableTestTrait {

    protected static $stringTestUtility;

    /**
     * @beforeClass
     */
    public static function initializeStringTestUtility() {
        self::$stringTestUtility = new StringTestUtility();
    }

    public function testGetTypeReturnsNonEmptyString() {
        self::$stringTestUtility->stringIsNotEmpty($this->classifiable->getType());
    }
}
