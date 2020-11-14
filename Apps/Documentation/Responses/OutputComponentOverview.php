<?php

/**
 * OutputComponentOverview.php
 * Responds to:
 * ./index.php?outputComponentOverview
 * ./?outputComponentOverview
 */

$appComponentsFactory->buildResponse(
    'OutputComponentOverview',
    2,
    $appComponentsFactory->buildRequest(
        'OutputComponentOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?outputComponentOverview',
    ),
    $appComponentsFactory->buildRequest(
        'OutputComponentOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?outputComponentOverview',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'OutputComponentOverview',
        'Output',
        0,
        'Documentation',
        'OutputComponentOverview.php'
    ),
);

