<?php

namespace UnitTests\TestTraits;

use DarlingCms\classes\utility\ReflectionUtility as RealReflectionUtility;

trait ReflectionUtility
{
    /**
     * @var RealReflectionUtility
     */
    private $reflectionUtility;

    /**
     * @before
     * @noinspection PhpUnused
     */
    public function initializeReflectionUtility(): void
    {
        $this->setReflectionUtility(new RealReflectionUtility());
    }

    private function setReflectionUtility(RealReflectionUtility $reflectionUtility)
    {
        $this->reflectionUtility = $reflectionUtility;
    }

    public function getReflectionUtility(): RealReflectionUtility
    {
        return $this->reflectionUtility;
    }

}