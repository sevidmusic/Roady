<?php

namespace roady\abstractions\component\Factory;

use roady\classes\primary\Classifiable as CoreClassifiable;
use roady\classes\primary\Exportable as CoreExportable;
use roady\classes\primary\Identifiable as CoreIdentifiable;
use roady\classes\primary\Positionable as CorePositionable;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

abstract class PrimaryFactory extends Factory implements PrimaryFactoryInterface
{

    public function __construct(AppInterface $app)
    {
        parent::__construct($app);
    }

    public function buildIdentifiable(string $name): IdentifiableInterface
    {
        return new CoreIdentifiable($name);
    }

    public function buildStorable(string $name, string $container): StorableInterface
    {
        return new CoreStorable($name, $this->export()['app']->getLocation(), $container);
    }

    public function buildClassifiable(): ClassifiableInterface
    {
        return new CoreClassifiable();
    }

    public function buildExportable(): ExportableInterface
    {
        return new CoreExportable();
    }

    public function buildSwitchable(): SwitchableInterface
    {
        return new CoreSwitchable();
    }


    public function buildPositionable(float $initialPosition): PositionableInterface
    {
        return new CorePositionable($initialPosition);
    }
}

