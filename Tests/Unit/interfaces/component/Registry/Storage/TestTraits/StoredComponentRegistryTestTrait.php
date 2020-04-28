<?php

namespace UnitTests\interfaces\component\Registry\Storage\TestTraits;

use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

trait StoredComponentRegistryTestTrait
{

    private $storedComponentRegistry;

    protected function setStoredComponentRegistryParentTestInstances(): void
    {
        $this->setComponent($this->getStoredComponentRegistry());
        $this->setComponentParentTestInstances();
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    public function setStoredComponentRegistry(StoredComponentRegistry $storedComponentRegistry)
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
    }

}