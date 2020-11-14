<?php

/**
 * WhatIsIt.php
 * Responds to:
 * ./?whatIsIt
 * ./index.php?whatIsIt
 */

$appComponentsFactory->buildResponse(
    'WhatIsIt',
    2,
    $appComponentsFactory->buildRequest(
        'WhatIsItRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/?whatIsIt', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildRequest(
        'WhatIsItRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?whatIsIt', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'WhatIsIt',
        'Output',
        0,
        'Documentation',
        'WhatIsIt.php'
    ),
);

