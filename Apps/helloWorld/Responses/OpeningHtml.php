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
        'OpeningHeadTag',
        'Components',
        '<head>',
        2
    ),
    $appComponentsFactory->buildOutputComponent(
        'Title',
        'Components',
        '<title>Darling Data Management System | Welcome</title>',
        2.1
    ),
    $appComponentsFactory->buildOutputComponent(
        'MetaViewport',
        'Components',
        '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
        2.12
    ),
    $appComponentsFactory->buildOutputComponent(
        'Styles',
        'Components',
        '<link rel="stylesheet" href="' . $appComponentsFactory->getAppDomain()->getUrl() . '/Apps/helloWorld/css/styles.css">',
        2.13
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHeadTag',
        'Components',
        '</head>',
        2.99999
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Components',
        '<body style="background: #000000;">',
        3000
    ),
);

