<?php

namespace roady\abstractions\component\Factory;

use roady\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use roady\interfaces\component\Component as ComponentInterfaces;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

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
        return ($this->getComponentCrud()->create($component) === true && $this->getStoredComponentRegistry()->registerComponent($component));
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
