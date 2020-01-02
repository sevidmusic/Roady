<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait StringTester
{

    /**
     * @var StringTestUtility
     */
    private $stringTestUtility;

    /**
     * @before
     * @noinspection PhpUnused
     */
    public function initializeStringTestUtility(): void
    {
        $this->setStringTestUtility(new StringTestUtility());
    }

    private function setStringTestUtility(StringTestUtility $stringTestUtility): void
    {
        if (!isset($this->stringTestUtility)) {
            $this->stringTestUtility = $stringTestUtility;
        }
    }

    public function getStringTestUtility(): StringTestUtility
    {
        return $this->stringTestUtility;
    }

}
