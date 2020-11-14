<?php

/**
 * ResponseOverview.php
 * Responds to:
 * ./index.php?responseOverview
 * ./?responseOverview
 */

$appComponentsFactory->buildResponse(
    'ResponseOverview',
    3,
    $appComponentsFactory->buildRequest(
        'ResponseOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?responseOverview',
    ),
    $appComponentsFactory->buildRequest(
        'ResponseOverviewRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?responseOverview',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'ResponseOverview',
        'Output',
        0,
        'Documentation',
        'ResponseOverview.php'
    ),
);

