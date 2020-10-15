<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use DarlingDataManagementSystem\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplate;

abstract class StandardUITemplateFactory extends StoredComponentFactoryBase implements StandardUITemplateFactoryInterface
{

    public function __construct(PrimaryFactoryInterface $primaryFactory, ComponentCrudInterface $componentCrud, StoredComponentRegistryInterface $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponentInterface ...$types
    ): StandardUITemplate
    {
        $standardUITemplate = new CoreStandardUITemplate(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                $container
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        foreach ($types as $type) {
            $standardUITemplate->addType($type);
        }
        $this->storeAndRegister($standardUITemplate);
        return $standardUITemplate;
    }

}
