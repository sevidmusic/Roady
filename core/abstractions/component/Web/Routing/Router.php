<?php

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class Router extends SwitchableComponent implements RouterInterface
{

    private $request;
    private $crud;

    public function __construct(Storable $storable, Switchable $switchable, Request $request, ComponentCrud $crud)
    {
        parent::__construct($storable, $switchable);
        $this->request = $request;
        $this->crud = $crud;
        if ($this->crud->getState() === false) {
            $this->crud->switchState();
        }
    }

    public function getResponses(string $location, string $container): array
    {
        if ($this->getState() === false) {
            return [];
        }
        $responses = [];
        foreach ($this->getCrud()->readAll($location, $container) as $response) {
            if ($this->isValidResponse($response) === false || $response->getState() === false) {
                continue;
            }
            if ($response->respondsToRequest($this->getRequest(), $this->getCrud()) === true) {
                array_push($responses, $response);
            }
        }
        return $responses;
    }

    public function getCrud(): ComponentCrud
    {
        return $this->crud;
    }

    private function isValidResponse($response): bool
    {
        return (
            is_object($response)
            &&
            in_array(
                'DarlingDataManagementSystem\interfaces\component\Web\Routing\Response',
                class_implements($response)
            )
        );
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

}
