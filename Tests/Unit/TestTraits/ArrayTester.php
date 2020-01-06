<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\ArrayTestUtility;


trait ArrayTester
{

    private $arrayTestUtility;

    /**
     * @before
     */
    public function initializeArrayTestUtility(): void
    {
        $this->setArrayTestUtility(new ArrayTestUtility());
    }

    private function setArrayTestUtility(ArrayTestUtility $arrayTestUtility): void
    {
        if (!isset($this->arrayTestUtility)) {
            $this->arrayTestUtility = $arrayTestUtility;
        }
    }

    public function getArrayTestUtility(): ArrayTestUtility
    {
        return $this->arrayTestUtility;
    }

}
