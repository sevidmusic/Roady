<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterfaces;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App as AppInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

abstract class StoredComponentFactory extends CoreSwitchableComponent implements StoredComponentFactoryInterface
{

    private PrimaryFactoryInterface $primaryFactory;
    private StoredComponentRegistryInterface $storedComponentRegistry;
    private AppInterface $app;

    public function __construct(PrimaryFactoryInterface $primaryFactory, ComponentCrudInterface $componentCrud, StoredComponentRegistryInterface $storedComponentRegistry)
    {
        parent::__construct(
            $primaryFactory->buildStorable(
                $primaryFactory->getApp()->getName(),
                $primaryFactory::CONTAINER
            ),
            $componentCrud
        );
        $this->storedComponentRegistry = $storedComponentRegistry;
        $this->primaryFactory = $primaryFactory;
        $this->app = $primaryFactory->getApp();
    }

    public function getPrimaryFactory(): PrimaryFactoryInterface
    {
        return $this->primaryFactory;
    }

    public function storeAndRegister(ComponentInterfaces $component): bool
    {
        return ($this->getComponentCrud()->create($component) === true ? $this->getStoredComponentRegistry()->registerComponent($component) : false);
    }

    public function getComponentCrud(): ComponentCrudInterface
    {
        return $this->export()['switchable'];
    }

    public function getStoredComponentRegistry(): StoredComponentRegistryInterface
    {
        return $this->storedComponentRegistry;
    }

    public function getAppDomain(): RequestInterface
    {
        return $this->getApp()->getAppDomain();
    }

    public function getApp(): AppInterface
    {
        return $this->app;
    }


}
