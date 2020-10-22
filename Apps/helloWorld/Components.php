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
    AppComponentsFactory::buildDomain('http://localhost:8832')
)
);

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    0,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildOutputComponent(
            'OutputComponent',
            'Components',
            '',
            0
        )
    ),
    $appComponentsFactory->buildOutputComponent(
        'OutputComponent',
        'Components',
        '<div style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #E5581A; color: #000000;"><a href="index.php">Home</a></div>',
        0
    )
);

$appComponentsFactory->buildResponse(
    'Response',
    0,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildOutputComponent(
            'OutputComponent',
            'Components',
            '',
            0
        )
    ),
    $appComponentsFactory->buildOutputComponent(
        'OutputComponent',
        'Components',
        '<div style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #E5581A; color: #000000;"><a href="/">App Root</a></div>',
        2
    ),
    $appComponentsFactory->buildOutputComponent(
        'OutputComponent',
        'Components',
        '<p style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #1AA7E5; color: #000000;">Hello World</p>',
        0
    ),
    $appComponentsFactory->buildRequest(
        'Home',
        'Components',
        $appComponentsFactory->getAppDomain()->getUrl() . '/index.php'
    )
);


$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

