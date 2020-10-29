<?php

$appComponentsFactory->buildGlobalResponse(
    'Homepage',
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
        'Welcome',
        'Components',
        0,
        'helloWorld',
        'Welcome.html'
    ),
);

