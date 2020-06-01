<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\classes\component\OutputComponent as CoreOutputComponent;

abstract class AppComponentsFactory extends CoreStoredComponentFactory implements AppComponentsFactoryInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildOutputComponent(string $name, string $conatiner, string $output, float $position): OutputComponent
    {
        $oc = new CoreOutputComponent(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                $conatiner
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        $oc->import(['output' => $output]);
        $this->getComponentCrud()->create($oc);
        $this->getStoredComponentRegistry()->registerComponent($oc);
        return $oc;
    }

}
