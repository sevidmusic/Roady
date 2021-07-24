<?php

namespace UnitTests\TestTraits;

use roady\classes\utility\ReflectionUtility as CoreReflectionUtility;

trait ReflectionUtilityInstance
{

    private CoreReflectionUtility $reflectionUtility;

    /**
     * @before
     */
    public function initializeReflectionUtility(): void
    {
        $this->setReflectionUtility(new CoreReflectionUtility());
    }

    private function setReflectionUtility(CoreReflectionUtility $reflectionUtility) : void
    {
        if (!isset($this->reflectionUtility)) {
            $this->reflectionUtility = $reflectionUtility;
        }
    }

    public function getReflectionUtility(): CoreReflectionUtility
    {
        return $this->reflectionUtility;
    }

}
