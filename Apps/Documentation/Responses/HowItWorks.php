<?php

/**
 * HowItWorks.php
 * Responds to:
 * ./?howItWorks
 * ./index.php?howItWorks
 */

$appComponentsFactory->buildResponse(
    'HowItWorks',
    2,
    $appComponentsFactory->buildRequest(
        'HowItWorksRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?howItWorks',
    ),
    $appComponentsFactory->buildRequest(
        'HowItWorksRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?howItWorks',
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'HowItWorks',
        'Output',
        0,
        'Documentation',
        'HowItWorks.php'
    ),
);

