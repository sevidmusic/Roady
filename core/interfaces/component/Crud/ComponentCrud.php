<?php

namespace DarlingCms\interfaces\component\Crud;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\primary\Storable;

interface ComponentCrud extends SwitchableComponent
{

    public function create(Component $component): bool;

    public function read(Storable $storable): Component;

    public function update(Storable $storable, Component $component): bool;

    public function delete(Storable $storable): bool;

    public function readAll(string $location, string $container): array;

}
