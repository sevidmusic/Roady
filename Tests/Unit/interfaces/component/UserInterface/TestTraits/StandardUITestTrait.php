<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\UserInterface\StandardUI;

trait StandardUITestTrait
{

    private $standardUI;
    private $router;
/*
    public static function setUpBeforeClass(): void
    {
  trying to avoid this method...static sucks
    }
*/
    public function getStandardUITestStandardUIContainer()
    {
        return 'StandardUITestUIContainer';
    }

    public function getStandardUITestRouterContainer()
    {
        return "StandardUITestRouterContainer";
    }

    public function getStandardUITestCurrentRequest(): Request
    {
        return new Request(
            new Storable(
                'StandardUICurrentRequest',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestRequestContainer()
            ),
            new Switchable()
        );
    }

    public function getStandardUITestComponentLocation()
    {
        return 'StandardUITestComponents';
    }

    public function getStandardUITestRequestContainer()
    {
        return "StandardUITestRequestContainer";
    }

    public function getStandardUITestComponentCrudForTestRouter()
    {
        return new ComponentCrud(
            new Storable(
                'StandardUIComponentCrud',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestComponentCrudContainer()
            ),
            new Switchable(),
            new StorageDriver(
                new Storable(
                    'StandardUIStorageDriver',
                    $this->getStandardUITestComponentLocation(),
                    $this->getStandardUITestStorageDriverContainer()
                ),
                new Switchable()
            )
        );
    }

    public function getStandardUITestRouter(): Router
    {
        if (isset($this->router)) {
            return $this->router;
        }
        $this->router = new Router(
            new Storable(
                'StandardUI_AbstractTestRouter',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestRouterContainer()
            ),
            new Switchable(),
            $this->getStandardUITestCurrentRequest(),
            $this->getStandardUITestComponentCrudForTestRouter()
        );
        return $this->router;
    }

    public function getStandardUITestComponentCrudContainer()
    {
        return "StandardUITestComponentCruds";
    }

    public function getStandardUITestStorageDriverContainer()
    {
        return "StandardUITestStorageDrivers";
    }

    protected function setStandardUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getStandardUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getStandardUI(): StandardUI
    {
        return $this->standardUI;
    }

    public function setStandardUI(StandardUI $standardUI): void
    {
        $this->standardUI = $standardUI;
    }
}
