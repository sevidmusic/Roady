<?php

namespace DarlingDataManagementSystem\abstractions\utility;

use DarlingDataManagementSystem\interfaces\utility\AppBuilder as AppBuilderInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use \Exception;

abstract class AppBuilder implements AppBuilderInterface
{

    public static function getAppsAppComponentsFactory(string $appName, string $domain): AppComponentsFactoryInterface
    {
        $domainRequest = self::buildAppDomain($domain);
        $appComponentsFactory = self::newAppComponentsFactory($appName, $domainRequest);
        try {
            /**
             * @var AppComponentsFactoryInterface $appComponentsFactory
             */
            $appComponentsFactory = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                $appComponentsFactory->getName(),
                $appComponentsFactory->getType(),
                CoreApp::deriveNameLocationFromRequest($domainRequest),
                AppComponentsFactory::CONTAINER
            );
        } catch(Exception $e) {
            $appComponentsFactory->getComponentCrud()->create($appComponentsFactory);
        }
        return $appComponentsFactory;
    }

    /**
     * Build the Components configured for the App by requiring the Component
     * configuration files found in the specified directory in the relevant App's
     * directory.
     *
     * Note: The directory must exist in the App directory that corresponds to the
     *       App assigned to the provided AppComponentsFactory.
     *       For example, if $appComponentsFactory->getApp()->getName() returns
     *       "HelloWorld" then the directory should exist at:
     *          HelloWorld/$configurationDirectoryName
     *
     * @param string $configurationDirectoryName The name of the configuration directory
     *                                           that contains the Component configuration
     *                                           files that define the Components to build.
     *
     * @param AppComponentsFactoryInterface $appComponentsFactory The AppComponentsFactory to
     *                                                            use to build the configured
     *                                                            Components.
     *
     */
    private static function buildAppsConfiguredComponents(string $configurationDirectoryName, AppComponentsFactoryInterface $appComponentsFactory): void {
        # Once implemented in core, use $appComponentsFactory->getApp()->getName() to determine App's directory name
        $appName = $appComponentsFactory->getApp()->getName();
        $configurationDirectoryPath = str_replace(
            'core' . DIRECTORY_SEPARATOR . 'abstractions' . DIRECTORY_SEPARATOR . 'utility',
            'Apps' . DIRECTORY_SEPARATOR . $appName . DIRECTORY_SEPARATOR . $configurationDirectoryName . DIRECTORY_SEPARATOR,
            __DIR__
        );
        if(file_exists($configurationDirectoryPath) && is_dir($configurationDirectoryPath)) {
            $scan = scandir($configurationDirectoryPath);
            $ls = (is_array($scan) ? $scan : []);
            foreach(array_diff($ls, array('.', '..')) as $file) {
                $expectedFilePath = $configurationDirectoryPath . $file;
                if(substr($file, -4, 4) === '.php' && file_exists($expectedFilePath) && is_file($expectedFilePath)) {
                    $realPath = strval(realpath($expectedFilePath));
                    $fileContents = strval(file_get_contents($realPath));
                    if(str_contains($fileContents, '$appComponentsFactory->build')) {
                        require $realPath;
                    }
                }
            }
        }
        $appComponentsFactory->getComponentCrud()->update($appComponentsFactory, $appComponentsFactory);
    }

    public static function buildApp(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        self::removeRegisteredComponents($appComponentsFactory);
        self::buildAppsConfiguredComponents('OutputComponents', $appComponentsFactory);
    }

    /**
     * Remove all the Components registered by the provided AppComponentsFactory
     * from storage.
     *
     * @param AppComponentsFactoryInterface $appComponentsFactory The AppComponentsFactory whose regiseterd
     *                                                            Components should be removed.
     */
    private static function removeRegisteredComponents(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        foreach($appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents() as $registeredComponent) {
            if($registeredComponent->getType() !== CoreApp::class && $registeredComponent->getLocation() !== 'APP') {
                $appComponentsFactory->getComponentCrud()->delete($registeredComponent);
                $appComponentsFactory->getStoredComponentRegistry()->unRegisterComponent($registeredComponent);
            }
        }
        $appComponentsFactory->getComponentCrud()->update($appComponentsFactory, $appComponentsFactory);
    }

    /**
     * Return a new instance of an AppComponentsFactory for an App.
     * @param string $appName The name of the App to create a new AppComponentsFactory instance for.
     * @param RequestInterface $domain  The App's domain.
     * @return AppComponentsFactoryInterface A new AppComponentsFactory instance.
     */
    private static function newAppComponentsFactory(string $appName, RequestInterface $domain): AppComponentsFactoryInterface
    {
        return new AppComponentsFactory(
            ...AppComponentsFactory::buildConstructorArgs(
                $domain,
                new CoreApp($domain, new CoreSwitchable(), $appName)
            )
        );
    }

    /**
     * Return an appropritate Request to be used as the App's domain.
     * If $domain is a valid url, it will be used, if it
     * is not a valid url, http://localhost:8080 will be used.
     * @param string $domain The App's domain.
     * @return RequestInterface A Request instance that represents the App's domain.
     */
    private static function buildAppDomain(string $domain): RequestInterface
    {
        $domain = str_replace(["'"], [''], $domain);
        if(filter_var($domain, FILTER_VALIDATE_URL)) {
            $useDomain = $domain;
        }
        return AppComponentsFactory::buildDomain(($useDomain ?? 'http://localhost:8080'));
    }

}
