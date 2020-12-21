<?php

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\Web\App;

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
    AppComponentsFactory::buildDomain('http://testdomain.dev')
    )
);

$opts = getopt('a:');
$appName = $opts['a'];
$app = $appComponentsFactory->getComponentCrud()->readByNameAndType(
    $appName,
    App::class,
    $appName,
    App::APP_CONTAINER
);

echo '\n\e[102m\e[30mApp name: ' . $appName;
