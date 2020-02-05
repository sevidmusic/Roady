<?php

namespace DarlingCms\interfaces\component\Driver\Storage\FileSystem;


use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\primary\Storable;

interface Json extends SwitchableComponent
{

    public function getStorageDirectoryPath(): string;

    public function getStoragePath(Storable $storable): string;

    public function write(Component $component): bool;

    public function read(Storable $storable): Component;

    public function delete(Storable $storable): bool;

    public function readAll(string $location, string $container): array;
}
