<?php

$appComponentsFactory->buildResponse(
    'Homepage',
    0,
    $appComponentsFactory->buildRequest(
        'HomepageRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Welcome',
        'Components',
        0,
        'helloUniverse',
        'Welcome.php'
    ),
);

