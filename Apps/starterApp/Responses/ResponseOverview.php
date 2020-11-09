<?php

$appComponentsFactory->buildResponse(
    'ResponseOverview',
    3,
    $appComponentsFactory->buildRequest(
        'ResponseOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?outputComponentOverview',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'ResponseOverview',
        'Output',
        0,
        'starterApp',
        'ResponseOverview.php'
    ),
);

