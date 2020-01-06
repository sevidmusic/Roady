<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait StringTester
{

    private $stringTestUtility;

    /**
     * @before
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
