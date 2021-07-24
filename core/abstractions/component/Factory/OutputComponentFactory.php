<?php

namespace roady\abstractions\component\Factory;

use roady\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use roady\classes\component\OutputComponent as CoreOutputComponent;
use roady\classes\component\DynamicOutputComponent as CoreDynamicOutputComponent;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

abstract class OutputComponentFactory extends CoreStoredComponentFactory implements OutputComponentFactoryInterface
{

    public function __construct(PrimaryFactoryInterface $primaryFactory, ComponentCrudInterface $componentCrud, StoredComponentRegistryInterface $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponentInterface
    {
        $outputComponent = new CoreOutputComponent(
            $this->getPrimaryFactory()->buildStorable($name, $container),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        $outputComponent->import(['output' => $output]);
        $this->storeAndRegister($outputComponent);
        return $outputComponent;
    }


    public function buildDynamicOutputComponent(string $name, string $container, float $position, string $appDirectoryName, string $dynamicFileName): DynamicOutputComponentInterface
    {
        $dynamicOutputComponent = new CoreDynamicOutputComponent(
            $this->getPrimaryFactory()->buildStorable($name, $container),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position),
            $appDirectoryName,
            $dynamicFileName
        );
        $this->storeAndRegister($dynamicOutputComponent);
        return $dynamicOutputComponent;
    }
}
