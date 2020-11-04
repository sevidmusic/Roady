<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;

trait ResponseUITestTrait
{

    private $responseUI;

    protected function setResponseUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getResponseUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getResponseUI(): ResponseUIInterface
    {
        return $this->responseUI;
    }

    public function setResponseUI(ResponseUIInterface $responseUI): void
    {
        $this->responseUI = $responseUI;
    }

    public function getResponseUITestArgs(): array
    {
        return [
            new CoreStorable(
                'MockResponseUIName',
                'MockResponseUILocation',
                'MockResponseUIContainer'
            ),
            new CoreSwitchable(),
            new CorePositionable()
        ];
    }

    public function getRouter(): RouterInterface
    {
        if (isset($this->router)) {
            return $this->router;
        }
        $this->router = new CoreRouter(
            new CoreStorable(
                'StandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRouterContainer()
            ),
            new CoreSwitchable(),
            $this->getCurrentRequest(),
            $this->getComponentCrudForRouter()
        );
        return $this->router;
    }

    public function getComponentLocation(): string
    {
        return 'DEFAULT';
    }

    public function getRouterContainer(): string
    {
        return "StandardUITestRouterContainer";
    }

    public function getCurrentRequest(): RequestInterface
    {
        if (isset($this->currentRequest) === true) {
            return $this->currentRequest;
        }
        $this->currentRequest = new CoreRequest(
            new CoreStorable(
                'StandardUICurrentRequest' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRequestContainer()
            ),
            new CoreSwitchable()
        );
        $this->getRouter()->getCrud()->create($this->currentRequest);
        return $this->currentRequest;
    }

    public function getRequestContainer(): string
    {
        return "StandardUITestRequestContainer";
    }

    private function getComponentCrudForRouter(): ComponentCrudInterface
    {
        if (isset($this->router) === true) {
            return $this->getRouter()->getCrud();
        }
        return new CoreComponentCrud(
            new CoreStorable(
                'StandardUITestComponentCrudForStandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getComponentCrudContainer()
            ),
            new CoreSwitchable(),
            $this->getStandardStorageDriverForCrud()
        );
    }

    public function getComponentCrudContainer(): string
    {
        return "StandardUITestComponentCruds";
    }

    private function getStandardStorageDriverForCrud(): StandardStorageDriverInterface
    {
        return new JsonStorageDriver(
            new CoreStorable(
                'StandardUITestStorageDriver' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getStandardStorageDriverContainer()
            ),
            new CoreSwitchable()
        );
    }


}
