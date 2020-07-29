<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\classes\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use DarlingCms\classes\component\Factory\StandardUITemplateFactory as CoreStandardUITemplateFactory;
use DarlingCms\classes\component\Factory\RequestFactory as CoreRequestFactory;
use DarlingCms\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\interfaces\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Response as CoreResponse;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable as CoreSwitchable;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Web\Routing\GlobalResponse;

abstract class AppComponentsFactory extends CoreStoredComponentFactory implements AppComponentsFactoryInterface
{

    private $outputComponentFactory;
    private $standardUITemplateFactory;
    private $requestFactory;
    private $responseFactory;
    private const REFLECTION_UTILITY = 'reflectionUtility';
    private const ACCEPTED_IMPLEMENTATION = 'acceptedImplementation';
    private const CONSTRUCT = '__construct';

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
        $this->prepareOutputComponentFactory(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
        $this->prepareStandardUITemplateFactory(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
        $this->prepareRequestFactory(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
        $this->prepareResponseFactory(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
        $this->getStoredComponentRegistry()->import(
            [
                self::ACCEPTED_IMPLEMENTATION
                =>
                Component::class
            ]
        );
        $this->getComponentCrud()->create($primaryFactory->export()['app']);
        $this->getStoredComponentRegistry()->registerComponent(
            $primaryFactory->export()['app']
        );
    }

    private function prepareOutputComponentFactory(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $registry = $this->export()[self::REFLECTION_UTILITY]->getClassInstance(
            $storedComponentRegistry->getType(),
            $this->export()[self::REFLECTION_UTILITY]->generateMockClassMethodArguments(
                $storedComponentRegistry->getType(),
                self::CONSTRUCT
            )
        );
        $registry->import(
            [
                self::ACCEPTED_IMPLEMENTATION
                =>
                OutputComponent::class
            ]
        );
        $this->outputComponentFactory = new CoreOutputComponentFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    public function buildOutputComponent(
        string $name,
        string $container,
        string $output,
        float $position
    ): OutputComponent
    {
        $oc = $this->outputComponentFactory->buildOutputComponent(
            $name,
            $container,
            $output,
            $position
        );
        $this->getStoredComponentRegistry()->registerComponent($oc);
        return $oc;
    }

    private function prepareStandardUITemplateFactory(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $registry = $this->export()[self::REFLECTION_UTILITY]->getClassInstance(
            $storedComponentRegistry->getType(),
            $this->export()[self::REFLECTION_UTILITY]->generateMockClassMethodArguments(
                $storedComponentRegistry->getType(),
                self::CONSTRUCT
            )
        );
        $registry->import(
            [
                self::ACCEPTED_IMPLEMENTATION
                =>
                StandardUITemplate::class
            ]
        );
        $this->standardUITemplateFactory = new CoreStandardUITemplateFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    private function prepareRequestFactory(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $registry = $this->export()[self::REFLECTION_UTILITY]->getClassInstance(
            $storedComponentRegistry->getType(),
            $this->export()[self::REFLECTION_UTILITY]->generateMockClassMethodArguments(
                $storedComponentRegistry->getType(),
                self::CONSTRUCT
            )
        );
        $registry->import(
            [
                self::ACCEPTED_IMPLEMENTATION
                =>
                Request::class
            ]
        );
        $this->requestFactory = new CoreRequestFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    private function prepareResponseFactory(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $registry = $this->export()[self::REFLECTION_UTILITY]->getClassInstance(
            $storedComponentRegistry->getType(),
            $this->export()[self::REFLECTION_UTILITY]->generateMockClassMethodArguments(
                $storedComponentRegistry->getType(),
                self::CONSTRUCT
            )
        );
        $registry->import(
            [
                self::ACCEPTED_IMPLEMENTATION
                =>
                Response::class
            ]
        );
        $this->responseFactory = new CoreResponseFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponent ...$types
    ): StandardUITemplate
    {
        $suit = $this->standardUITemplateFactory->buildStandardUITemplate(
            $name,
            $container,
            $position,
        );
        $this->standardUITemplateFactory->getStoredComponentRegistry()->unregisterComponent(
            $suit
        );
        foreach($types as $type) {
            $suit->addType($type);
        }
        $this->standardUITemplateFactory->getComponentCrud()->update($suit, $suit);
        $this->standardUITemplateFactory->getStoredComponentRegistry()->registerComponent($suit);
        $this->getStoredComponentRegistry()->registerComponent($suit);
        return $suit;
    }

    private static function buildPrimaryFactory(Request $domain): PrimaryFactory
    {
        return new CorePrimaryFactory(new CoreApp($domain, new CoreSwitchable()));
    }

    private static function buildComponentCrud(Request $domain): ComponentCrud
    {
        return new CoreComponentCrud(
            self::buildPrimaryFactory($domain)->buildStorable('Crud', 'Cruds'),
            self::buildPrimaryFactory($domain)->buildSwitchable(),
            new Standard(
                self::buildPrimaryFactory($domain)->buildStorable('StorageDriver', 'StorageDrivers'),
                self::buildPrimaryFactory($domain)->buildSwitchable()
            )
        );
    }

    private static function buildStoredComponentRegistry(Request $domain): StoredComponentRegistry
    {
        return new CoreStoredComponentRegistry(
            self::buildPrimaryFactory($domain)->buildStorable(
                'AppComponentsRegistry',
                'StoredComponentRegistries'
            ),
            self::buildComponentCrud($domain)
        );
    }

    public static function buildConstructorArgs(Request $domain): array
    {
        return [
            self::buildPrimaryFactory($domain),
            self::buildComponentCrud($domain),
            self::buildStoredComponentRegistry($domain)
        ];
    }

    public static function buildDomain(string $url): Request
    {
        $storable = new Storable('TEMP', 'TEMP', 'TEMP');
        $domain = new CoreRequest(
            $storable,
            new CoreSwitchable()
        );
        $domain->import(['url' => $url]);
        $actualStorable = new Storable(
            CoreApp::deriveNameLocationFromRequest($domain),
            CoreApp::deriveNameLocationFromRequest($domain),
            CoreApp::deriveNameLocationFromRequest($domain),
        );
        $domain->import(['storable' => $actualStorable]);
        return $domain;
    }

    public function buildRequest(string $name, string $container, string $url): Request
    {
        $request = $this->requestFactory->buildRequest($name, $container, $url);
        $this->getStoredComponentRegistry()->registerComponent($request);
        return $request;
    }

    public function buildResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): Response
    {
        $response = $this->responseFactory->buildResponse($name, $position);
        $this->responseFactory->getStoredComponentRegistry()->unregisterComponent(
            $response
        );
        foreach($requestsOutputComponentsStandardUITemplates as $component)
        {
            CoreResponseFactory::ifRequestAddStorageInfo($response, $component);
            CoreResponseFactory::ifStandardUITemplateAddStorageInfo($response, $component);
            CoreResponseFactory::ifOutputComponentAddStorageInfo($response, $component);
        }
        $this->responseFactory->getComponentCrud()->update($response, $response);
        $this->responseFactory->getStoredComponentRegistry()->registerComponent($response);
        $this->getStoredComponentRegistry()->registerComponent($response);
        return $response;
    }

    public function buildGlobalResponse(float $position, Component ...$requestsOutputComponentsStandardUITemplates): GlobalResponse
    {
        $globalResponse = $this->responseFactory->buildGlobalResponse($position);
        $this->responseFactory->getStoredComponentRegistry()->unregisterComponent(
            $globalResponse
        );
        foreach($requestsOutputComponentsStandardUITemplates as $component)
        {
            CoreResponseFactory::ifRequestAddStorageInfo($globalResponse, $component);
            CoreResponseFactory::ifStandardUITemplateAddStorageInfo($globalResponse, $component);
            CoreResponseFactory::ifOutputComponentAddStorageInfo($globalResponse, $component);
        }
        $this->responseFactory->getComponentCrud()->update($globalResponse, $globalResponse);
        $this->responseFactory->getStoredComponentRegistry()->registerComponent($globalResponse);
        $this->getStoredComponentRegistry()->registerComponent($globalResponse);
        return $globalResponse;
    }

    public function buildLog($flags = 0): string {
        $buildLog = "";
        foreach(
            $this->getStoredComponentRegistry()->getRegisteredComponents()
            as
            $storable
        )
        {
            $message = sprintf(
                '%sBuilt %s:%s    Name: %s%s    Container: %s%s    Location: %s%s    Type: %s%s    UniqueId: %s%s',
                PHP_EOL,
                $storable->getType(),
                PHP_EOL,
                "\033[42m" . $storable->getName() . "\033[0m",
                PHP_EOL,
                "\033[1;32m" . $storable->getContainer() . "\033[0m",
                PHP_EOL,
                "\033[44m" . $storable->getLocation() . "\033[0m",
                PHP_EOL,
                "\033[1;34m" . $storable->getType() . "\033[0m",
                PHP_EOL,
                "\033[46m" . $storable->getUniqueId() . "\033[0m",
                PHP_EOL
            );
            if($flags & self::SHOW_LOG) { echo $message; usleep(250000); }
            $buildLog .= $message;
        }
        /*
        if($flags & SAVE_LOG) {
            file_put_contents(__DIR__ . '/buildLog.txt', $buildLog);
        }
         */
        return $buildLog;
    }
}
