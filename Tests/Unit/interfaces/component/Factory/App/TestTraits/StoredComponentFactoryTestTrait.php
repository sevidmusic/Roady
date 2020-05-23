<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\classes\primary\Switchable as CoreSwitchable;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

trait StoredComponentFactoryTestTrait
{

    private $storedComponentFactory;
    private $app;

    protected function setStoredComponentFactoryParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStoredComponentFactory());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getStoredComponentFactory(): StoredComponentFactory
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactory(StoredComponentFactory $storedComponentFactory): void
    {
        $this->storedComponentFactory = $storedComponentFactory;
    }

    protected function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
    }

    public function testAppPropertyIsAssignedAppImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Web\App',
                $this->getStoredComponentFactory()->export()['app']
            )
        );
    }

    protected function getMockApp(): App
    {
        if(empty($this->app) === true)
        {
            $currentRequest = new CoreRequest(
                new CoreStorable(
                    'CurrentRequest',
                    'Requests',
                    'Index'
                ),
                new CoreSwitchable()
            );
            $this->app = new CoreApp($currentRequest, new CoreSwitchable());
        }
        return $this->app;
    }

}
