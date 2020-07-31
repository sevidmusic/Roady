<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;

abstract class StandardUITemplateFactory extends CoreStoredComponentFactory implements StandardUITemplateFactoryInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponent ...$types
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
