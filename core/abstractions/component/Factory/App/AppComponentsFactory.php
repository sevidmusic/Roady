<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory\App;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingDataManagementSystem\classes\component\Factory\RequestFactory as CoreRequestFactory;
use DarlingDataManagementSystem\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingDataManagementSystem\classes\component\Factory\StandardUITemplateFactory as CoreStandardUITemplateFactory;
use DarlingDataManagementSystem\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

abstract class AppComponentsFactory extends StoredComponentFactoryBase implements AppComponentsFactoryInterface
{

    private const REFLECTION_UTILITY = 'reflectionUtility';
    private const ACCEPTED_IMPLEMENTATION = 'acceptedImplementation';
    private const CONSTRUCT = '__construct';
    private ?OutputComponentFactoryInterface $outputComponentFactory = null;
    private ?StandardUITemplateFactoryInterface $standardUITemplateFactory = null;
    private ?RequestFactoryInterface $requestFactory = null;
    private ?ResponseFactoryInterface $responseFactory = null;

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
                    ComponentInterface::class
            ]
        );
        $this->getComponentCrud()->create($primaryFactory->export()['app']);
        $this->getStoredComponentRegistry()->registerComponent(
            $primaryFactory->export()['app']
        );
    }

    private function prepareOutputComponentFactory(
        PrimaryFactoryInterface $primaryFactory,
        ComponentCrudInterface $componentCrud,
        StoredComponentRegistryInterface $storedComponentRegistry
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
                    OutputComponentInterface::class
            ]
        );
        $this->outputComponentFactory = new CoreOutputComponentFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    private function prepareStandardUITemplateFactory(
        PrimaryFactoryInterface $primaryFactory,
        ComponentCrudInterface $componentCrud,
        StoredComponentRegistryInterface $storedComponentRegistry
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
                    StandardUITemplateInterface::class
            ]
        );
        $this->standardUITemplateFactory = new CoreStandardUITemplateFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    private function prepareRequestFactory(
        PrimaryFactoryInterface $primaryFactory,
        ComponentCrudInterface $componentCrud,
        StoredComponentRegistryInterface $storedComponentRegistry
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
                    RequestInterface::class
            ]
        );
        $this->requestFactory = new CoreRequestFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    private function prepareResponseFactory(
        PrimaryFactoryInterface $primaryFactory,
        ComponentCrudInterface $componentCrud,
        StoredComponentRegistryInterface $storedComponentRegistry
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
                    ResponseInterface::class
            ]
        );
        $this->responseFactory = new CoreResponseFactory(
            $primaryFactory,
            $componentCrud,
            $registry
        );
    }

    public static function buildConstructorArgs(RequestInterface $domain): array
    {
        return [
            self::buildPrimaryFactory($domain),
            self::buildComponentCrud($domain),
            self::buildStoredComponentRegistry($domain)
        ];
    }

    private static function buildPrimaryFactory(RequestInterface $domain): PrimaryFactoryInterface
    {
        return new CorePrimaryFactory(new CoreApp($domain, new CoreSwitchable()));
    }

    private static function buildComponentCrud(RequestInterface $domain/* @todo , $storageDriver = null */): ComponentCrudInterface
    {
        /* @todo Implement optional $storageDriver parameter so alternative to JsonStorageDriver can be specified */
        return new CoreComponentCrud(
            self::buildPrimaryFactory($domain)->buildStorable('Crud', 'Cruds'),
            self::buildPrimaryFactory($domain)->buildSwitchable(),
            new JsonStorageDriver(
                self::buildPrimaryFactory($domain)->buildStorable('StorageDriver', 'StorageDrivers'),
                self::buildPrimaryFactory($domain)->buildSwitchable()
            )
        );
    }

    private static function buildStoredComponentRegistry(RequestInterface $domain): StoredComponentRegistryInterface
    {
        return new CoreStoredComponentRegistry(
            self::buildPrimaryFactory($domain)->buildStorable(
                'AppComponentsRegistry',
                'StoredComponentRegistries'
            ),
            self::buildComponentCrud($domain)
        );
    }

    public static function buildDomain(string $url): RequestInterface
    {
        $storable = new CoreStorable('TEMP', 'TEMP', 'TEMP');
        $domain = new CoreRequest(
            $storable,
            new CoreSwitchable()
        );
        $domain->import(['url' => $url]);
        $actualStorable = new CoreStorable(
            CoreApp::deriveNameLocationFromRequest($domain),
            CoreApp::deriveNameLocationFromRequest($domain),
            CoreApp::deriveNameLocationFromRequest($domain),
        );
        $domain->import(['storable' => $actualStorable]);
        return $domain;
    }

    public function buildOutputComponent(
        string $name,
        string $container,
        string $output,
        float $position
    ): OutputComponentInterface
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

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponentInterface ...$types
    ): StandardUITemplateInterface
    {
        $suit = $this->standardUITemplateFactory->buildStandardUITemplate(
            $name,
            $container,
            $position,
        );
        $this->standardUITemplateFactory->getStoredComponentRegistry()->unregisterComponent(
            $suit
        );
        foreach ($types as $type) {
            $suit->addType($type);
        }
        $this->standardUITemplateFactory->getComponentCrud()->update($suit, $suit);
        $this->standardUITemplateFactory->getStoredComponentRegistry()->registerComponent($suit);
        $this->getStoredComponentRegistry()->registerComponent($suit);
        return $suit;
    }

    public function buildRequest(string $name, string $container, string $url): RequestInterface
    {
        $request = $this->requestFactory->buildRequest($name, $container, $url);
        $this->getStoredComponentRegistry()->registerComponent($request);
        return $request;
    }

    public function buildResponse(string $name, float $position, ComponentInterface ...$requestsOutputComponentsStandardUITemplates): ResponseInterface // @todo As soon as Php 8 is in use, refactor to union type declaration: i.e Response | GlobalResponse
    {
        $response = $this->responseFactory->buildResponse($name, $position);
        return $this->configureResponse($response, $requestsOutputComponentsStandardUITemplates);
    }

    /**
     * @param ResponseInterface $response
     * @param array $requestsOutputComponentsStandardUITemplates
     * @return ResponseInterface|GlobalResponseInterface
     */
    private function configureResponse(ResponseInterface $response, array $requestsOutputComponentsStandardUITemplates = [])
    {
        $this->responseFactory->getStoredComponentRegistry()->unregisterComponent(
            $response
        );
        foreach ($requestsOutputComponentsStandardUITemplates as $component) {
            CoreResponseFactory::ifRequestAddStorageInfo($response, $component);
            CoreResponseFactory::ifStandardUITemplateAddStorageInfo($response, $component);
            CoreResponseFactory::ifOutputComponentAddStorageInfo($response, $component);
        }
        $this->responseFactory->getComponentCrud()->update($response, $response);
        $this->responseFactory->getStoredComponentRegistry()->registerComponent($response);
        $this->getStoredComponentRegistry()->registerComponent($response);
        return $response;
    }

    public function buildGlobalResponse(string $name, float $position, ComponentInterface ...$requestsOutputComponentsStandardUITemplates): GlobalResponseInterface
    {
        $globalResponse = $this->responseFactory->buildGlobalResponse($name, $position);
        return $this->configureResponse($globalResponse, $requestsOutputComponentsStandardUITemplates);
    }

    public function buildLog($flags = 0): string
    {
        $buildLog = "";
        foreach (
            $this->getStoredComponentRegistry()->getRegisteredComponents()
            as
            $storable
        ) {
            /** @noinspection DuplicatedCode */
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
            if ($flags & self::SHOW_LOG) {
                echo $message;
                usleep(250000);
            }
            $buildLog .= $message;
        }
        if ($flags & self::SAVE_LOG) {
            if (is_dir($this->expectedBuildLogDirectoryPath()) === false) {
                mkdir($this->expectedBuildLogDirectoryPath());
            }
            file_put_contents($this->expectedBuildLogPath(), $buildLog);
            echo sprintf(
                '%sSaved build log to: %s',
                PHP_EOL,
                "\033[1;34m" . $this->expectedBuildLogPath() . "\033[0m" . PHP_EOL
            );
            sleep(1);
        }
        return $buildLog;
    }

    private function expectedBuildLogDirectoryPath(): string
    {
        return str_replace(
            'core/abstractions/component/Factory/App',
            'Apps' .
            DIRECTORY_SEPARATOR .
            '.buildLogs' .
            DIRECTORY_SEPARATOR,
            __DIR__
        );
    }

    private function expectedBuildLogPath(): string
    {
        return $this->expectedBuildLogDirectoryPath() . $this->getPrimaryFactory()->export()['app']->getName();
    }

}
