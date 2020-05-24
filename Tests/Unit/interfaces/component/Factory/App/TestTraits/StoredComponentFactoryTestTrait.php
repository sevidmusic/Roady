<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as CoreStandardStorageDriver;
use DarlingCms\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\classes\primary\Switchable as CoreSwitchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Web\App;

trait StoredComponentFactoryTestTrait
{

    private $storedComponentFactory;
    private $app;

    public function testPrimaryFactoryPropertyIsAssignedPrimaryFactoryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Factory\PrimaryFactory',
                $this->getStoredComponentFactory()->export()['primaryFactory']
            )
        );
    }

    protected function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
    }

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

    protected function getMockPrimaryFactory(): PrimaryFactory
    {
        return new CorePrimaryFactory($this->getMockApp());
    }

    protected function getMockApp(): App
    {
        if (empty($this->app) === true) {
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

    public function testSwitchablePropertyIsAssignedComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Crud\ComponentCrud',
                $this->getStoredComponentFactory()->export()['switchable']
            )
        );
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'Temp', 'Temp'),
            new CoreSwitchable(),
            new CoreStandardStorageDriver(
                new CoreStorable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new CoreSwitchable()
            )
        );
    }

}
