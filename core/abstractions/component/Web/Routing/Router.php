<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\abstractions\component\SwitchableComponent;
use DarlingCms\classes\component\Crud\ComponentCrud as Crud;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class Router extends SwitchableComponent implements RouterInterface
{

    private $request;
    private $crud;

    public function __construct(Storable $storable, Switchable $switchable, Request $request, Crud $crud)
    {
        parent::__construct($storable, $switchable);
        $this->request = $request;
        $this->crud = $crud;
    }

    public function getResponses(string $location, string $container): array
    {
        $responses = [];
        foreach ($this->getCrud()->readAll($location, $container) as $response) {
            if ($this->isValidResponse($response) === false || $response->getState() === false) {
                continue;
            }
            if ($response->respondsToRequest($this->getRequest()) === true) {
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
                'DarlingCms\interfaces\component\Web\Routing\Response',
                class_implements($response)
            )
        );
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

}
