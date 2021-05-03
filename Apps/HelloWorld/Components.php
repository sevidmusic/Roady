<?php

/**
 * Components.php
 */

use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
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
        $scan = scandir($configurationDirectoryPath);
        $ls = (is_array($scan) ? $scan : []);
        foreach(array_diff($ls, array('.', '..')) as $file) {
            require $configurationDirectoryPath . $file;
        }
    }

    /**
     * Either create and return a new AppComponentsFactory for the App, or return
     * the existing AppComponentsFactory from storage.
     *
     * @param string $appName The name of the App the factory belongs to.
     * @param string $specifiedDomain The App's domain, example: http://localhost:8080
     * @return AppComponentsFactoryInterface
     */
    public static function getAppsAppComponentsFactory(string $appName, string $specifiedDomain): AppComponentsFactoryInterface {
        if(filter_var($specifiedDomain, FILTER_VALIDATE_URL)) {
            $useDomain = $specifiedDomain;
        }
        $actualDomain = AppComponentsFactory::buildDomain(($useDomain ?? 'http://localhost:8080/'));
        $appComponentsFactory = new AppComponentsFactory(
            ...AppComponentsFactory::buildConstructorArgs(
                $actualDomain,
                new CoreApp($actualDomain, new CoreSwitchable(), $appName)
            )
        );
        try {
            /**
             * @var AppComponentsFactoryInterface $appComponentsFactory
             */
            $appComponentsFactory = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                $appComponentsFactory->getName(),
                $appComponentsFactory->getType(),
                CoreApp::deriveNameLocationFromRequest($actualDomain),
                AppComponentsFactory::CONTAINER
            );
        } catch(Exception $e) {
            $appComponentsFactory->getComponentCrud()->create($appComponentsFactory);
        }
        return $appComponentsFactory;
    }

    private static function cleanUpDEFAULTApps(string $appName, string $specifiedDomain): void
    {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $specifiedDomain);
        foreach($appComponentsFactory->getComponentCrud()->readAll('DEFAULT', 'APP') as $r) {
            $appComponentsFactory->getComponentCrud()->delete($r);
        }
    }

    private static function cleanUpDuplicateApps(string $appName, string $specifiedDomain): void
    {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $specifiedDomain);
        foreach($appComponentsFactory->getComponentCrud()->readAll('localhost8080', 'APP') as $r) {
            if($r->getUniqueId() !== $appComponentsFactory->getApp()->getUniqueId()) {
                $appComponentsFactory->getComponentCrud()->delete($r);
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

    public static function buildApp(string $appName, string $specifiedDomain): void {
        $appComponentsFactory = self::getAppsAppComponentsFactory($appName, $specifiedDomain);
        self::removeRegisteredComponents($appComponentsFactory);
        /** !BUG This should not be neccessary! Fix duplicate Apps of same name type location container...*/
        self::cleanUpDuplicateApps($appName, $specifiedDomain);
        /** !BUG This should not be neccessary! Fix duplicate Apps of same name type location container...*/
        self::cleanUpDEFAULTApps($appName, $specifiedDomain);
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

