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
    private $currentRequest;
/*
    public static function setUpBeforeClass(): void
    {
  trying to avoid this method...static sucks
    }
*/
    public function getStandardUITestStandardUIContainer()
    {
        return 'StandardUITestStandardUIContainer';
    }

    public function getStandardUITestRouterContainer()
    {
        return "StandardUITestRouterContainer";
    }

    public function getStandardUITestCurrentRequest(): Request
    {
        if(isset($this->currentRequest) === true)
        {
            return  $this->currentRequest;
        }
        $this->currentRequest = new Request(
            new Storable(
                'StandardUICurrentRequest',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestRequestContainer()
            ),
            new Switchable()
        );
        return $this->currentRequest;
    }

    public function getStandardUITestComponentLocation()
    {
        return 'StandardUITestComponentsLocation';
    }

    public function getStandardUITestRequestContainer()
    {
        return "StandardUITestRequestContainer";
    }

    private function getStandardUITestComponentCrudForTestRouter()
    {
        if(isset($this->router) === true) {
            return $this->getStandardUITestRouter()->getCrud();
        }
        return new ComponentCrud(
            new Storable(
                'StandardUITestComponentCrudForStandardUITestRouter',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestComponentCrudContainer()
            ),
            new Switchable(),
            new StorageDriver(
                new Storable(
                    'StandardUITestStorageDriver',
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
                'StandardUITestRouter',
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
