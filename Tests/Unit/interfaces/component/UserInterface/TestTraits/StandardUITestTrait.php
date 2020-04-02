<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\UserInterface\StandardUI;

trait StandardUITestTrait
{

    private $standardUI;
    private $router;
    private $currentRequest;

    public function getStandardUITestStandardUIContainer()
    {
        return 'StandardUITestStandardUIContainer';
    }

    protected function getStandardUITestStandardUITemplateContainer(): string
    {
        return 'StandardUITestStandardUITemplateContainer';
    }

    protected function generateStoredTestComponents()
    {
        // Output Components
        $this->generateOutputComponent();

        // Templates

        // Responses

        // ??? Store current request to emulate more realistic use, typically requests will exists as stored Components
    }

    private function generateOutputComponent(): OutputComponent
    {
        $outputComponent = new OutputComponent(
            new Storable(
                '',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestOutputComponentContainer()
            ),
            new Switchable(),
            new Positionable((rand(0, 100) / 100))
        );
        $outputComponent->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        $this->getStandardUITestRouter()->getCrud()->create($outputComponent);
        return $outputComponent;
    }

    public function getStandardUITestOutputComponentContainer(): string
    {
        return "StandardUITestOutputComponentContainer";
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

    public function getStandardUITestRouterContainer()
    {
        return "StandardUITestRouterContainer";
    }

    public function getStandardUITestCurrentRequest(): Request
    {
        if (isset($this->currentRequest) === true) {
            return $this->currentRequest;
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

    public function getStandardUITestRequestContainer()
    {
        return "StandardUITestRequestContainer";
    }

    private function getStandardUITestComponentCrudForTestRouter()
    {
        if (isset($this->router) === true) {
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

    private function generateStandardUITemplate(): StandardUITemplate
    {
        $standardUITemplate = new StandardUITemplate(
            new Storable(
                'StandardUITestTemplate',
                $this->getStandardUITestComponentLocation(),
                $this->getStandardUITestStandardUITemplateContainer()
            ),
            new Switchable(),
            new Positionable((rand(0,100) / 100))
        );
        $standardUITemplate->addType($this->generateOutputComponent());
        $this->getStandardUITestRouter()->getCrud()->create($standardUITemplate);
        return $standardUITemplate;
    }

    public function getStandardUITestComponentLocation()
    {
        return 'StandardUITestComponentsLocation';
    }
}
