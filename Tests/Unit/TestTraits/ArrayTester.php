<?php

namespace UnitTests\TestTraits;

use UnitTests\TestUtilities\ArrayTestUtility;


trait ArrayTester
{

    /**
     * @var ArrayTestUtility
     */
    private $arrayTestUtility;

    /**
     * @before
     * @noinspection PhpUnused
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
