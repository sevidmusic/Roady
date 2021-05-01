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

class AppBuilder {

    public static function loadComponentConfigFiles(string $configurationDirectoryName, AppComponentsFactoryInterface $appComponentsFactory): void {
        $configurationDirectoryPath = __DIR__ . DIRECTORY_SEPARATOR . $configurationDirectoryName . DIRECTORY_SEPARATOR;
        $scan = scandir($configurationDirectoryPath);
        $ls = (is_array($scan) ? $scan : []);
        foreach(array_diff($ls, array('.', '..')) as $file) {
            require $configurationDirectoryPath . $file;
        }
    }

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
        var_dump($appComponentsFactory->getUniqueId());
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
            var_dump('Created Factory', $appComponentsFactory->getComponentCrud()->create($appComponentsFactory));
        }
        var_dump($appComponentsFactory->getUniqueId());
        return $appComponentsFactory;
    }

    public static function buildApp(string $appName, string $specifiedDomain): void {
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $specifiedDomain);
        AppBuilder::loadComponentConfigFiles('OutputComponents', $appComponentsFactory);
        AppBuilder::loadComponentConfigFiles('Requests', $appComponentsFactory);
        AppBuilder::loadComponentConfigFiles('Responses', $appComponentsFactory);
        $appComponentsFactory->buildLog(AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG);
    }
}

$appName = 'HelloWorld';
$domain = (escapeshellarg($argv[1] ?? ''));
AppBuilder::buildApp($appName, $domain);

