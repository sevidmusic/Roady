<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\primary\Classifiable;
use DarlingCms\interfaces\primary\Exportable;
use DarlingCms\interfaces\primary\Identifiable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

interface PrimaryFactory extends Factory
{

    public function buildIdentifiable(string $name): Identifiable;

    public function buildStorable(string $name, string $container): Storable;

    public function buildClassifiable(): Classifiable;

    public function buildExportable(): Exportable;

    public function buildSwitchable(): Switchable;

    public function buildPositionable(float $initialPosition): Positionable;

}
