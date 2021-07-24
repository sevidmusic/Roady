<?php

namespace roady\interfaces\component\Driver\Storage;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\primary\Storable as StorableInterface;

interface StorageDriver extends SwitchableComponentInterface
{
    public function write(ComponentInterface $component): bool;

    public function read(StorableInterface $storable): ComponentInterface;

    public function delete(StorableInterface $storable): bool;

    /**
     * @return array<ComponentInterface>
     */
    public function readAll(string $location, string $container): array;

}
