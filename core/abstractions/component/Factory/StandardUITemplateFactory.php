<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;
use DarlingCms\interfaces\component\OutputComponent;

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
    ): StandardUITemplate {
        $standardUITemplate = new CoreStandardUITemplate(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                $container
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        foreach($types as $type) {
            $standardUITemplate->addType($type);
        }
        $this->storeAndRegister($standardUITemplate);
        return $standardUITemplate;
    }

}
