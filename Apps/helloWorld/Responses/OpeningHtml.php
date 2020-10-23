<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
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
        'Doctype',
        'Components',
        '<!DOCTYPE html>',
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHtmlTag',
        'Components',
        '<html lang="en">',
        1
    ),
    $appComponentsFactory->buildOutputComponent(
        'Head',
        'Components',
        '<head><title>Darling Data Management System | Welcome</title><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>',
        2
    ),
    $appComponentsFactory->buildOutputComponent(
        'MainStyleSheet',
        'Components',
        '<link rel="stylesheet" href="' . $appComponentsFactory->getAppDomain()->getUrl() . '/Apps/helloWorld/css/styles.css">',
        3
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Components',
        '<body style="background: #000000;">',
        3000
    ),
);


