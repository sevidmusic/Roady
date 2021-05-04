<?php

/**
 * Components.php
 */

use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;

ini_set('display_errors', 'true');

require(
    strval(
        realpath(
            str_replace(
                'Apps' . DIRECTORY_SEPARATOR . strval(basename(__DIR__)),
                'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
                __DIR__
            )
        )
    )
);

class AppManager {

    public static function loadComponentConfigFiles(string $configurationDirectoryName, AppComponentsFactoryInterface $appComponentsFactory): void {
        $configurationDirectoryPath = __DIR__ . DIRECTORY_SEPARATOR . $configurationDirectoryName . DIRECTORY_SEPARATOR;
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
        if(filter_var($domain, FILTER_VALIDATE_URL)) {
            $useDomain = $domain;
        }
        return AppComponentsFactory::buildDomain(($useDomain ?? 'http://localhost:8080'));
    }

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
     * Either create and return a new AppComponentsFactory for the App, or return
     * the existing AppComponentsFactory from storage.
     *
     * @param string $appName The name of the App the factory belongs to.
     * @param string $domain The App's domain, example: http://localhost:8080
     * @return AppComponentsFactoryInterface
     */
    public static function getAppsAppComponentsFactory(string $appName, string $domain): AppComponentsFactoryInterface {
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

    private static function cleanUpDEFAULTApps(string $appName, string $domain): void
    {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $domain);
        foreach($appComponentsFactory->getComponentCrud()->readAll('DEFAULT', 'APP') as $component) {
            $appComponentsFactory->getComponentCrud()->delete($component);
        }
    }

    private static function cleanUpDuplicateApps(string $appName, string $domain): void
    {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $domain);
        foreach($appComponentsFactory->getComponentCrud()->readAll(
            $appComponentsFactory->getApp()->getLocation(),
            $appComponentsFactory->getApp()->getContainer()
        ) as $component) {
            if($component->getUniqueId() !== $appComponentsFactory->getApp()->getUniqueId()) {
                $appComponentsFactory->getComponentCrud()->delete($component);
            }
        }
    }

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

    public static function buildApp(string $appName, string $domain): void {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $domain);
        self::removeRegisteredComponents($appComponentsFactory);
#########
        /** !BUG This should not be neccessary! Fix duplicate Apps of same name type location container...*/
        self::cleanUpDuplicateApps($appName, $domain);
        /** !BUG This should not be neccessary! Fix duplicate Apps of same name type location container...*/
        self::cleanUpDEFAULTApps($appName, $domain);
#########
        self::loadComponentConfigFiles('OutputComponents', $appComponentsFactory);
        self::loadComponentConfigFiles('Requests', $appComponentsFactory);
        self::loadComponentConfigFiles('Responses', $appComponentsFactory);
        $appComponentsFactory->getComponentCrud()->update($appComponentsFactory, $appComponentsFactory);
        $appComponentsFactory->buildLog(AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG);
    }
}

$appName = 'HelloWorld';
$domain = (escapeshellarg($argv[1] ?? ''));
AppManager::buildApp($appName, $domain);

