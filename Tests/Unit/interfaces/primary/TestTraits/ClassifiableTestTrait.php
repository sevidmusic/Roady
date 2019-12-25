<?php

/** @noinspection PhpUnused */

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Classifiable;
use UnitTests\TestTraits\StringTester;

trait ClassifiableTestTrait
{
    use StringTester;

    /**
     * @var Classifiable
     */
    protected $classifiable;

    public function testGetTypeReturnsNonEmptyString()
    {
        self::$stringTestUtility->stringIsNotEmpty($this->classifiable->getType());
    }
}
