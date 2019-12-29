<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait StringTester
{

    /**
     * @var StringTestUtility
     */
    private static $stringTestUtility;

    /**
     * @beforeClass
     * @noinspection PhpUnused
     */
    public static function initializeStringTestUtility(): void
    {
        self::$stringTestUtility = new StringTestUtility();
    }

    public function getStringTestUtility(): StringTestUtility
    {
        return self::$stringTestUtility;
    }

}
