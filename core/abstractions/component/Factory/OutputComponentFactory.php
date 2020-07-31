<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;

abstract class OutputComponentFactory extends CoreStoredComponentFactory implements OutputComponentFactoryInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponent
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
