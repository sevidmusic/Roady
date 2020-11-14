<?php

$appComponentsFactory->buildResponse(
    'HowItWorks',
    2,
    $appComponentsFactory->buildRequest(
        'HowItWorksRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?howItWorks', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildRequest(
        'HowItWorksRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?howItWorks', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Welcome',
        'Output',
        0,
        'Documentation',
        'HowItWorks.php'
    ),
);

