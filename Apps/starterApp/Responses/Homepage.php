<?php

$appComponentsFactory->buildResponse(
    'Homepage',
    2,
    $rootRequest,
    $homepageRequest,
    $appComponentsFactory->buildDynamicOutputComponent(
        'Welcome',
        'Output',
        0,
        'starterApp',
        'Welcome.php'
    ),
);

