<?php

namespace roady\interfaces\component\Crud;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\primary\Storable as StorableInterface;

interface ComponentCrud extends SwitchableComponentInterface
{

    public function create(ComponentInterface $component): bool;

    public function read(StorableInterface $storable): ComponentInterface;

    public function update(StorableInterface $storable, ComponentInterface $component): bool;

    public function delete(StorableInterface $storable): bool;

    /**
     * @return array<ComponentInterface>
     */
    public function readAll(string $location, string $container): array;

    public function readByNameAndType(string $name, string $type, string $location, string $container): ComponentInterface;

}
