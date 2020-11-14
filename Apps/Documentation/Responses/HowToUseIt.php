<?php

/**
 * HowToUseIt.php
 * Responds to:
 * ./index.php?howToUseIt
 * ./?howToUseIt
 */

$appComponentsFactory->buildResponse(
    'HowToUseIt',
    2,
    $appComponentsFactory->buildRequest(
        'HowToUseItRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?howToUseIt', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildRequest(
        'HowToUseItRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?howToUseIt', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'HowToUseIt',
        'Output',
        0,
        'Documentation',
        'HowToUseIt.php'
    ),
);

