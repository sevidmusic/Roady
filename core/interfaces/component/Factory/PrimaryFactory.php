<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\primary\Classifiable as ClassifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Exportable as ExportableInterface;
use DarlingDataManagementSystem\interfaces\primary\Identifiable as IdentifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

interface PrimaryFactory extends Factory
{

    public function buildIdentifiable(string $name): IdentifiableInterface;

    public function buildStorable(string $name, string $container): StorableInterface;

    public function buildClassifiable(): ClassifiableInterface;

    public function buildExportable(): ExportableInterface;

    public function buildSwitchable(): SwitchableInterface;

    public function buildPositionable(float $initialPosition): PositionableInterface;

}
