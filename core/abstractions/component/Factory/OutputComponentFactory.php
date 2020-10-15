<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

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
}
