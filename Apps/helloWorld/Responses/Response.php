<?php

$appComponentsFactory->buildResponse(
    'Response',
    0,
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
        'AppRootLink',
        'Components',
        '<div style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #E5581A; color: #000000;"><a href="/">App Root</a></div>',
        2
    ),
    $appComponentsFactory->buildOutputComponent(
        'HelloWorld',
        'Components',
        '<p style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #1AA7E5; color: #000000;">Hello World</p>',
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHtml',
        'Components',
        '</body></html>',
        1
    ),

    $appComponentsFactory->buildRequest(
        'HomeRequest',
        'Components',
        $appComponentsFactory->getAppDomain()->getUrl() . '/index.php'
    )
);

