<?php

namespace roady\interfaces\component\Driver\Storage;

use roady\interfaces\component\Component; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 

interface StorageDriver extends SwitchableComponent
{
    public function write(Component $component): bool;

    public function read(Storable $storable): Component;

    public function delete(Storable $storable): bool;

    /**
     * @return array<Component>
     */
    public function readAll(string $location, string $container): array;

}
