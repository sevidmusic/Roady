<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    1,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildOutputComponent(
            'OutputComponent',
            'Components',
            '',
            0
        ),
        $appComponentsFactory->buildDynamicOutputComponent(
            'DynamicOutputComponent',
            'Components',
            0,
            'helloWorld',
            'Duplicate.php'
        ),
    ),
    $appComponentsFactory->buildOutputComponent(
        'HomeLink',
        'Components',
        '<div class="menu">',
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HomeLink',
        'Components',
        '<a href="index.php">Home</a>',
        1
    ),
    $appComponentsFactory->buildOutputComponent(
        'AppDomainLink',
        'Components',
        '<a href="/">App Domain</a>',
        1.1
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'DateTime',
        'Components',
        1.2,
        'helloWorld',
        'Duplicate.php',
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingMenuDiv',
        'Components',
        '</div>',
        1000
    ),
);


