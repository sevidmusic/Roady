<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse as CoreGlobalResponse;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

abstract class ResponseFactory extends StoredComponentFactoryBase implements ResponseFactoryInterface
{

    public function __construct(
        PrimaryFactoryInterface $primaryFactory,
        ComponentCrudInterface $componentCrud,
        StoredComponentRegistryInterface $storedComponentRegistry
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
        ComponentInterface ...$componentsToAssign
    ): ResponseInterface
    {
        $response = new CoreResponse(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                CoreResponse::RESPONSE_CONTAINER,
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        foreach ($componentsToAssign as $component) {
            self::ifRequestAddStorageInfo($response, $component);
            self::ifStandardUITemplateAddStorageInfo($response, $component);
            self::ifOutputComponentAddStorageInfo($response, $component);
        }
        $this->storeAndRegister($response);
        return $response;
    }

    /**
     * @param string|object $class
     * @return array<string,string>
     */
    private static function classImplements(string|object $class): array
    {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
    }

    /**
     * @param ResponseInterface $response
     * @param ComponentInterface|RequestInterface $component
     */
    public static function ifRequestAddStorageInfo(ResponseInterface $response, ComponentInterface $component): void
    {
        if (
            in_array(
                RequestInterface::class,
                self::classImplements($component)
            ) === true
        ) {
            /**
             * @var RequestInterface $component
             */
            $response->addRequestStorageInfo($component);
        }
    }

    /**
     * @param ResponseInterface $response
     * @param ComponentInterface|StandardUITemplateInterface $component
     */
    public static function ifStandardUITemplateAddStorageInfo(ResponseInterface $response, ComponentInterface $component): void
    {
        if (
            in_array(
                StandardUITemplateInterface::class,
                self::classImplements($component)
            ) === true
        ) {
            /**
             * @var StandardUITemplateInterface $component
             */
            $response->addTemplateStorageInfo($component);
        }
    }

    /**
     * @param ResponseInterface $response
     * @param ComponentInterface|OutputComponentInterface $component
     */
    public static function ifOutputComponentAddStorageInfo(ResponseInterface $response, ComponentInterface $component): void
    {
        if (
            in_array(
                OutputComponentInterface::class,
                self::classImplements($component)
            ) === true
        ) {
            /**
             * @var OutputComponentInterface $component
             */
            $response->addOutputComponentStorageInfo($component);
        }
    }

    public function buildGlobalResponse(
        string $name,
        float $position,
        ComponentInterface ...$componentsToAssign
    ): GlobalResponseInterface
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
        foreach ($componentsToAssign as $component) {
            self::ifRequestAddStorageInfo($globalResponse, $component);
            self::ifStandardUITemplateAddStorageInfo($globalResponse, $component);
            self::ifOutputComponentAddStorageInfo($globalResponse, $component);
        }
        $this->storeAndRegister($globalResponse);
        return $globalResponse;
    }
}
