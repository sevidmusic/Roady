<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Component;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

trait ComponentTestTrait
{
    use StorableTestTrait;

    private $component;

    public function getComponent(): Component
    {
        return $this->component;
    }

    public function setComponent(Component $component)
    {
        $this->component = $component;
    }

}
