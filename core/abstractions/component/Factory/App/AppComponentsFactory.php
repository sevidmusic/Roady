<?php

namespace roady\abstractions\component\Factory\App;

use roady\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use roady\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use roady\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use roady\classes\component\Factory\RequestFactory as CoreRequestFactory;
use roady\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use roady\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use roady\classes\component\Web\App as CoreApp;
use roady\classes\component\Web\Routing\Request as CoreRequest;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use roady\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\interfaces\component\Web\App as AppInterface;
use RuntimeException;

abstract class AppComponentsFactory extends StoredComponentFactoryBase implements AppComponentsFactoryInterface
{

    private const REFLECTION_UTILITY = 'reflectionUtility';
    private const ACCEPTED_IMPLEMENTATION = 'acceptedImplementation';
    private const CONSTRUCT = '__construct';
    private ?OutputComponentFactoryInterface $outputComponentFactory = null;
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

    /**
     * @return array{0: PrimaryFactoryInterface, 1: ComponentCrudInterface, 2: StoredComponentRegistryInterface}
     */
    public static function buildConstructorArgs(RequestInterface $domain, AppInterface|null $app = null): array
    {
        return [
            self::buildPrimaryFactory($domain, $app),
            self::buildComponentCrud($domain),
            self::buildStoredComponentRegistry($domain)
        ];
    }

    private static function buildPrimaryFactory(RequestInterface $domain, AppInterface|null $app = null): PrimaryFactoryInterface
    {
        return (isset($app) ?  new CorePrimaryFactory($app) : new CorePrimaryFactory(new CoreApp($domain, new CoreSwitchable())) );
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
            CoreApp::deriveAppLocationFromRequest($domain),
            CoreApp::deriveAppLocationFromRequest($domain),
            CoreApp::deriveAppLocationFromRequest($domain),
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
        if(is_null($this->outputComponentFactory)) {
            throw new RuntimeException(self::class . 'Error: outputComponentFactory was not initialized!');
        }
        $oc = $this->outputComponentFactory->buildOutputComponent(
            $name,
            $container,
            $output,
            $position
        );
        $this->getStoredComponentRegistry()->registerComponent($oc);
        return $oc;
    }

    public function buildRequest(string $name, string $container, string $url): RequestInterface
    {
        if(is_null($this->requestFactory)) {
            throw new RuntimeException(self::class . 'Error: requestFactory was not initialized!');
        }
        $request = $this->requestFactory->buildRequest($name, $container, $url);
        $this->getStoredComponentRegistry()->registerComponent($request);
        return $request;
    }

    public function buildResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): ResponseInterface
    {
        if(is_null($this->responseFactory)) {
            throw new RuntimeException(self::class . 'Error: responseFactory was not initialized!');
        }
        $response = $this->responseFactory->buildResponse($name, $position);
        return $this->configureResponse($response, $componentsToAssign);
    }

    /**
     * @param ResponseInterface $response
     * @param array<int, ComponentInterface> $componentsToAssign
     * @return ResponseInterface|GlobalResponseInterface
     */
    private function configureResponse(ResponseInterface $response, array $componentsToAssign = []): ResponseInterface|GlobalResponseInterface
    {
        if(is_null($this->responseFactory)) {
            throw new RuntimeException(self::class . 'Error: responseFactory was not initialized!');
        }
        $this->responseFactory->getStoredComponentRegistry()->unregisterComponent(
            $response
        );
        foreach ($componentsToAssign as $component) {
            CoreResponseFactory::ifRequestAddStorageInfo($response, $component);
            CoreResponseFactory::ifOutputComponentAddStorageInfo($response, $component);
        }
        $this->responseFactory->getComponentCrud()->update($response, $response);
        $this->responseFactory->getStoredComponentRegistry()->registerComponent($response);
        $this->getStoredComponentRegistry()->registerComponent($response);
        return $response;
    }

    public function buildGlobalResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): GlobalResponseInterface
    {
        if(is_null($this->responseFactory)) {
            throw new RuntimeException(self::class . 'Error: responseFactory was not initialized!');
        }
        /**
         * @var GlobalResponseInterface $globalResponse
         */
        $globalResponse = $this->configureResponse($this->responseFactory->buildGlobalResponse($name, $position), $componentsToAssign);
        return $globalResponse;
    }

    public function buildLog(int $flags = 0): string
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

    public function buildDynamicOutputComponent(string $name, string $container, float $position, string $appDirectoryName, string $dynamicFileName): DynamicOutputComponentInterface
    {
        if(is_null($this->outputComponentFactory)) {
            throw new RuntimeException(self::class . 'Error: outputComponentFactory was not initialized!');
        }
        $doc = $this->outputComponentFactory->buildDynamicOutputComponent(
            $name,
            $container,
            $position,
            $appDirectoryName,
            $dynamicFileName
        );
        $this->getStoredComponentRegistry()->registerComponent($doc);
        return $doc;
    }

}
