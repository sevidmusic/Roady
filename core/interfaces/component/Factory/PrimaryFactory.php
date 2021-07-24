<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

interface PrimaryFactory extends Factory
{

    public function buildIdentifiable(string $name): IdentifiableInterface;

    public function buildStorable(string $name, string $container): StorableInterface;

    public function buildClassifiable(): ClassifiableInterface;

    public function buildExportable(): ExportableInterface;

    public function buildSwitchable(): SwitchableInterface;

    public function buildPositionable(float $initialPosition): PositionableInterface;

}
