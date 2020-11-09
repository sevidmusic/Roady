<?php

$appComponentsFactory->buildResponse(
    'OutputComponentOverview',
    2,
    $appComponentsFactory->buildRequest(
        'OutputComponentOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?outputComponentOverview',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'OutputComponentOverview',
        'Output',
        0,
        'starterApp',
        'OutputComponentOverview.php'
    ),
);

