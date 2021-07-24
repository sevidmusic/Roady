<?php

namespace roady\abstractions\component;

use roady\abstractions\primary\Exportable as ExportableBase;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\primary\Storable as StorableInterface;

abstract class Component extends ExportableBase implements ComponentInterface
{

    private StorableInterface $storable;

    public function __construct(StorableInterface $storable)
    {
        parent::__construct();
        $this->storable = $storable;
    }

    public function getName(): string
    {
        return $this->storable->getName();
    }

    public function getUniqueId(): string
    {
        return $this->storable->getUniqueId();
    }

    public function getLocation(): string
    {
        return $this->storable->getLocation();
    }

    public function getContainer(): string
    {
        return $this->storable->getContainer();
    }

}