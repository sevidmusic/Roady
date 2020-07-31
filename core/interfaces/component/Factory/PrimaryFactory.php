<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\primary\Classifiable;
use DarlingDataManagementSystem\interfaces\primary\Exportable;
use DarlingDataManagementSystem\interfaces\primary\Identifiable;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

interface PrimaryFactory extends Factory
{

    public function buildIdentifiable(string $name): Identifiable;

    public function buildStorable(string $name, string $container): Storable;

    public function buildClassifiable(): Classifiable;

    public function buildExportable(): Exportable;

    public function buildSwitchable(): Switchable;

    public function buildPositionable(float $initialPosition): Positionable;

}
