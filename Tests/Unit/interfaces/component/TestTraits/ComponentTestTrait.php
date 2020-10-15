<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait as StorableTestTraitInterface;

trait ComponentTestTrait
{
    use StorableTestTraitInterface;

    private ComponentInterface $component;

    public function getComponent(): ComponentInterface
    {
        return $this->component;
    }

    public function setComponent(ComponentInterface $component)
    {
        $this->component = $component;
    }

}
