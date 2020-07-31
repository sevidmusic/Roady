<?php

namespace DarlingDataManagementSystem\interfaces\component\Driver\Storage;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\primary\Storable;


interface Standard extends SwitchableComponent
{
    public function write(Component $component): bool;

    public function read(Storable $storable): Component;

    public function delete(Storable $storable): bool;

    public function readAll(string $location, string $container): array;

}
