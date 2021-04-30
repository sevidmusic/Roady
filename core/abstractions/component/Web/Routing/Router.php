<?php

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class Router extends SwitchableComponentBase implements RouterInterface
{

    private RequestInterface $request;
    private ComponentCrudInterface $crud;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, RequestInterface $request, ComponentCrudInterface $crud)
    {
        parent::__construct($storable, $switchable);
        $this->request = $request;
        $this->crud = $crud;
        if ($this->crud->getState() === false) {
            $this->crud->switchState();
        }
    }

    public function getResponseContainer(): string
    {
        return ResponseInterface::RESPONSE_CONTAINER;
    }

    /**
     * @return array<int, ResponseInterface>
     */
    public function getResponses(string $location, string $container): array
    {
        if ($this->getState() === false) {
            return [];
        }
        $responses = [];
        foreach ($this->getCrud()->readAll($location, $container) as $response) {
            /**
             * @var ResponseInterface $response
             */
            if ($this->isValidResponse($response) === false || $response->getState() === false) {
                continue;
            }
            if ($response->respondsToRequest($this->getRequest(), $this->getCrud()) === true) {
                array_push($responses, $response);
            }
        }
        return $responses;
    }

    public function getCrud(): ComponentCrudInterface
    {
        return $this->crud;
    }

    private function isValidResponse(mixed $response): bool
    {
        $classImplements = class_implements($response);
        return (
            is_object($response)
            &&
            in_array(
                'DarlingDataManagementSystem\interfaces\component\Web\Routing\Response',
                (is_array($classImplements) ? $classImplements : [])
            )
        );
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

}
