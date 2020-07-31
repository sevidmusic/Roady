<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\primary\Classifiable as CoreClassifiable;
use DarlingDataManagementSystem\classes\primary\Exportable as CoreExportable;
use DarlingDataManagementSystem\classes\primary\Identifiable as CoreIdentifiable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App;
use DarlingDataManagementSystem\interfaces\primary\Classifiable;
use DarlingDataManagementSystem\interfaces\primary\Exportable;
use DarlingDataManagementSystem\interfaces\primary\Identifiable;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class PrimaryFactory extends Factory implements PrimaryFactoryInterface
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function buildIdentifiable(string $name): Identifiable
    {
        return new CoreIdentifiable($name);
    }

    public function buildStorable(string $name, string $container): Storable
    {
        return new CoreStorable($name, $this->export()['app']->getLocation(), $container);
    }

    public function buildClassifiable(): Classifiable
    {
        return new CoreClassifiable();
    }

    public function buildExportable(): Exportable
    {
        return new CoreExportable();
    }

    public function buildSwitchable(): Switchable
    {
        return new CoreSwitchable();
    }


    public function buildPositionable(float $initialPosition): Positionable
    {
        return new CorePositionable($initialPosition);
    }
}

