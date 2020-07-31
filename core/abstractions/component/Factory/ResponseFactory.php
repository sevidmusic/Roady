<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse as CoreGlobalResponse;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response;

abstract class ResponseFactory extends CoreStoredComponentFactory implements ResponseFactoryInterface
{

    public function __construct(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    )
    {
        parent::__construct(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
    }

    public function buildResponse(
        string $name,
        float $position,
        Component ...$requestsOutputComponentsStandardUITemplates
    ): Response
    {
        $response = new CoreResponse(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                CoreResponse::RESPONSE_CONTAINER,
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        foreach ($requestsOutputComponentsStandardUITemplates as $component) {
            self::ifRequestAddStorageInfo($response, $component);
            self::ifStandardUITemplateAddStorageInfo($response, $component);
            self::ifOutputComponentAddStorageInfo($response, $component);
        }
        $this->storeAndRegister($response);
        return $response;
    }

    public static function ifRequestAddStorageInfo(Response $response, Component $component): void
    {
        if (
            in_array(
                Request::class,
                class_implements($component)
            ) === true
        ) {
            $response->addRequestStorageInfo($component);
        }
    }

    public static function ifStandardUITemplateAddStorageInfo(Response $response, Component $component): void
    {
        if (
            in_array(
                StandardUITemplate::class,
                class_implements($component)
            ) === true
        ) {
            $response->addTemplateStorageInfo($component);
        }
    }

    public static function ifOutputComponentAddStorageInfo(Response $response, Component $component): void
    {
        if (
            in_array(
                OutputComponent::class,
                class_implements($component)
            ) === true
        ) {
            $response->addOutputComponentStorageInfo($component);
        }
    }

    public function buildGlobalResponse(
        string $name,
        float $position,
        Component ...$requestsOutputComponentsStandardUITemplates
    ): GlobalResponse
    {
        $globalResponse = new CoreGlobalResponse(
            $this->getPrimaryFactory()->export()['app'],
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        $globalResponse->import(
            [
                'storable' => $this->getPrimaryFactory()->buildStorable(
                    $name,
                    $globalResponse->getContainer()
                )
            ]
        );
        foreach ($requestsOutputComponentsStandardUITemplates as $component) {
            self::ifRequestAddStorageInfo($globalResponse, $component);
            self::ifStandardUITemplateAddStorageInfo($globalResponse, $component);
            self::ifOutputComponentAddStorageInfo($globalResponse, $component);
        }
        $this->storeAndRegister($globalResponse);
        return $globalResponse;
    }
}
