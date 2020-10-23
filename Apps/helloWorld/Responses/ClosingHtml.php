<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    500000,
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
        'ClosingBodyTag',
        'Components',
        '</body>',
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHtmlTag',
        'Components',
        '</html>',
        1
    ),
);


