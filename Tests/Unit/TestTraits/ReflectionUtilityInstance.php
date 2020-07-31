<?php

namespace UnitTests\TestTraits;

use DarlingDataManagementSystem\classes\utility\ReflectionUtility as RealReflectionUtility;

trait ReflectionUtilityInstance
{

    private $reflectionUtility;

    /**
     * @before
     */
    public function initializeReflectionUtility(): void
    {
        $this->setReflectionUtility(new RealReflectionUtility());
    }

    private function setReflectionUtility(RealReflectionUtility $reflectionUtility)
    {
        if (!isset($this->reflectionUtility)) {
            $this->reflectionUtility = $reflectionUtility;
        }
    }

    public function getReflectionUtility(): RealReflectionUtility
    {
        return $this->reflectionUtility;
    }

}