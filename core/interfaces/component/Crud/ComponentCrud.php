<?php

namespace DarlingDataManagementSystem\interfaces\component\Crud;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\primary\Storable;

interface ComponentCrud extends SwitchableComponent
{

    public function create(Component $component): bool;

    public function read(Storable $storable): Component;

    public function update(Storable $storable, Component $component): bool;

    public function delete(Storable $storable): bool;

    public function readAll(string $location, string $container): array;

}
