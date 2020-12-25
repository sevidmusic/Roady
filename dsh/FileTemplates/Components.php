<?php

/** Apps/<APP_NAME>/Components.php */

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;

ini_set('display_errors', true);

require(
    '..' .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

function loadComponentConfigFiles(string $configurationDirectoryName, AppComponentsFactory $appComponentsFactory): void {
    $configurationDirectoryPath = __DIR__ . DIRECTORY_SEPARATOR . $configurationDirectoryName . DIRECTORY_SEPARATOR;
    foreach(array_diff(scandir($configurationDirectoryPath), array('.', '..')) as $file) {
        require $configurationDirectoryPath . $file;
    }
}

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs(
    AppComponentsFactory::buildDomain('http://localhost:8080')
    )
);

loadComponentConfigFiles('OutputComponents', $appComponentsFactory);
loadComponentConfigFiles('Requests', $appComponentsFactory);
loadComponentConfigFiles('Responses', $appComponentsFactory);

$appComponentsFactory->buildLog(AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG);

