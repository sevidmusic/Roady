<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\classes\primary\Classifiable as CoreClassifiable;
use DarlingCms\classes\primary\Exportable as CoreExportable;
use DarlingCms\classes\primary\Identifiable as CoreIdentifiable;
use DarlingCms\classes\primary\Positionable as CorePositionable;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\classes\primary\Switchable as CoreSwitchable;
use DarlingCms\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\interfaces\primary\Classifiable;
use DarlingCms\interfaces\primary\Exportable;
use DarlingCms\interfaces\primary\Identifiable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

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

