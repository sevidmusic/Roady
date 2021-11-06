<?php

namespace roady\interfaces\component\Crud;

use roady\interfaces\component\Component; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 

interface ComponentCrud extends SwitchableComponent
{

    public function create(Component $component): bool;

    public function read(Storable $storable): Component;

    public function update(Storable $storable, Component $component): bool;

    public function delete(Storable $storable): bool;

    /**
     * @return array<Component>
     */
    public function readAll(string $location, string $container): array;

    public function readByNameAndType(string $name, string $type, string $location, string $container): Component;

}
