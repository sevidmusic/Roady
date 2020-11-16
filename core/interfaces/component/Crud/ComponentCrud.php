<?php

namespace DarlingDataManagementSystem\interfaces\component\Crud;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

interface ComponentCrud extends SwitchableComponentInterface
{

    public function create(ComponentInterface $component): bool;

    public function read(StorableInterface $storable): ComponentInterface;

    public function update(StorableInterface $storable, ComponentInterface $component): bool;

    public function delete(StorableInterface $storable): bool;

    public function readAll(string $location, string $container): array;

    public function readByNameAndType(string $name, string $type, string $location, string $container): ComponentInterface;

}
