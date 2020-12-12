<?php

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;

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
    AppComponentsFactory::buildDomain('http://localhost:8080')
    )
);

$appComponentsFactory->buildGlobalResponse(
    'GlobalOutput',
    0,
    $appComponentsFactory->buildOutputComponent(
        'HelloWorld',
        'Output',
        'Hello World',
        0.0
    )
);

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

