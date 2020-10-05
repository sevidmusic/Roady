<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory\App;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\Standard;
use DarlingDataManagementSystem\classes\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingDataManagementSystem\classes\component\Factory\RequestFactory as CoreRequestFactory;
use DarlingDataManagementSystem\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingDataManagementSystem\classes\component\Factory\StandardUITemplateFactory as CoreStandardUITemplateFactory;
use DarlingDataManagementSystem\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response;

abstract class AppComponentsFactory extends CoreStoredComponentFactory implements AppComponentsFactoryInterface
{

    private const REFLECTION_UTILITY = 'reflectionUtility';
    private const ACCEPTED_IMPLEMENTATION = 'acceptedImplementation';
    private const CONSTRUCT = '__construct';
    private $outputComponentFactory;
    private $standardUITemplateFactory;
    private $requestFactory;
    private $responseFactory;

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

    public static function buildConstructorArgs(Request $domain): array
    {
        return [
            self::buildPrimaryFactory($domain),
            self::buildComponentCrud($domain),
            self::buildStoredComponentRegistry($domain)
        ];
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
        foreach ($types as $type) {
            $suit->addType($type);
        }
        $this->standardUITemplateFactory->getComponentCrud()->update($suit, $suit);
        $this->standardUITemplateFactory->getStoredComponentRegistry()->registerComponent($suit);
        $this->getStoredComponentRegistry()->registerComponent($suit);
        return $suit;
    }

    public function buildRequest(string $name, string $container, string $url): Request
    {
        $request = $this->requestFactory->buildRequest($name, $container, $url);
        $this->getStoredComponentRegistry()->registerComponent($request);
        return $request;
    }

    private function configureResponse(Response $response, array $requestsOutputComponentsStandardUITemplates = [])
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

    public function buildResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): Response // @todo As soon as Php 8 is in use, refactor to union type declaration: i.e Response | GlobalResponse
    {
        $response = $this->responseFactory->buildResponse($name, $position);
        return $this->configureResponse($response, $requestsOutputComponentsStandardUITemplates);
    }

    public function buildGlobalResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): GlobalResponse
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

    private function expectedBuildLogPath(): string
    {
        return str_replace(
            'core/abstractions/component/Factory/App',
            'Apps' .
            DIRECTORY_SEPARATOR .
            '.buildLogs' .
            DIRECTORY_SEPARATOR .
            $this->getPrimaryFactory()->export()['app']->getName(),
            __DIR__
        );
    }

}
