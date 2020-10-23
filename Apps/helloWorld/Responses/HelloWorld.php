<?php

$appComponentsFactory->buildResponse(
    'Response',
    2,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildOutputComponent(
            'OutputComponent',
            'Components',
            '',
            0
        )
    ),
    $appComponentsFactory->buildOutputComponent(
        'HelloWorld',
        'Components',
        '<p>Hello World</p>',
        0
    ),
    $appComponentsFactory->buildRequest(
        'HomeRequest',
        'Components',
        $appComponentsFactory->getAppDomain()->getUrl() . '/index.php'
    ),
);

