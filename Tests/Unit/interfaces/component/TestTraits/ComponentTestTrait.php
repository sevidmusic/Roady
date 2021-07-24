<?php

namespace UnitTests\interfaces\component\TestTraits;

use roady\interfaces\component\Component as ComponentInterface;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait as StorableTestTraitInterface;

trait ComponentTestTrait
{
    use StorableTestTraitInterface;

    private ComponentInterface $component;

    public function getComponent(): ComponentInterface
    {
        return $this->component;
    }

    public function setComponent(ComponentInterface $component): void
    {
        $this->component = $component;
    }

    protected function isProperImplementation(string $expectedImplementation, string|object $class): bool
    {
        $classImplements = class_implements($class);
        return in_array($expectedImplementation, (is_array($classImplements) ? $classImplements : []));
    }

}
