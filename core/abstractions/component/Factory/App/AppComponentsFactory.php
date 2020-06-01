<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\classes\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

abstract class AppComponentsFactory extends CoreStoredComponentFactory implements AppComponentsFactoryInterface
{

    private $outputComponentFactory;

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
        $this->prepareOutputComponentFactory($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    private function prepareOutputComponentFactory(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry): void
    {
        $ocfRegistry = $this->export()['reflectionUtility']->getClassInstance(
            $storedComponentRegistry->getType(),
            $this->export()['reflectionUtility']->generateMockClassMethodArguments(
                $storedComponentRegistry->getType(),
                '__construct'
            )
        );
        $ocfRegistry->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\OutputComponent']);
        $this->outputComponentFactory = new CoreOutputComponentFactory($primaryFactory, $componentCrud, $ocfRegistry);
    }

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponent
    {
        $oc = $this->outputComponentFactory->buildOutputComponent(
            $name,
            $container,
            $output,
            $position
        );
        $this->getStoredComponentRegistry()->registerComponent($oc);
        return $oc;
    }

}
