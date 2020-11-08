<?php

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

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs(
    AppComponentsFactory::buildDomain('http://localhost:8966')
    )
);

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/OpeningHtml.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/Homepage.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/LogoMainMenu.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/ClosingHtml.php';

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

