<?php

namespace DarlingCms\interfaces\component\Driver\Storage;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\primary\Storable;


interface Standard extends SwitchableComponent
{
    public function write(Component $component): bool;

    public function read(Storable $storable): Component;

    public function delete(Storable $storable): bool;

    public function readAll(string $location, string $container): array;

}
