<?php

/** @noinspection PhpUnused */

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Classifiable;
use UnitTests\TestUtilities\StringTestUtility;

trait ClassifiableTestTrait
{

    /**
     * @var StringTestUtility
     */
    protected static $stringTestUtility;

    /**
     * @var Classifiable
     */
    protected $classifiable;

    /**
     * @beforeClass
     */
    public static function initializeStringTestUtility()
    {
        self::$stringTestUtility = new StringTestUtility();
    }

    public function testGetTypeReturnsNonEmptyString()
    {
        self::$stringTestUtility->stringIsNotEmpty($this->classifiable->getType());
    }
}
