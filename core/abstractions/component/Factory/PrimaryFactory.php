<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\primary\Classifiable as CoreClassifiable;
use DarlingDataManagementSystem\classes\primary\Exportable as CoreExportable;
use DarlingDataManagementSystem\classes\primary\Identifiable as CoreIdentifiable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App as AppInterface;
use DarlingDataManagementSystem\interfaces\primary\Classifiable as ClassifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Exportable as ExportableInterface;
use DarlingDataManagementSystem\interfaces\primary\Identifiable as IdentifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

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

