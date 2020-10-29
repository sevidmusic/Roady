<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    3,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildDynamicOutputComponent(
            'DynamicOutputComponent',
            'Components',
            0,
            'helloWorld',
            'Duplicate.php'
        ),
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'MainMenu   ',
        'Components',
        0,
        'helloWorld',
        'MainMenu.html'
    ),
);

