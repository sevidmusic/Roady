<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\ArrayTestUtility;


trait ArrayTester
{

    /**
     * @var ArrayTestUtility
     */
    private static $arrayTestUtility;

    /**
     * @beforeClass
     * @noinspection PhpUnused
     */
    public static function initializeArrayTestUtility(): void
    {
        self::$arrayTestUtility = new ArrayTestUtility();
    }

    public function getArrayTestUtility(): ArrayTestUtility
    {
        return self::$arrayTestUtility;
    }

}
