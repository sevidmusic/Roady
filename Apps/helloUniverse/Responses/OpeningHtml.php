<?php

$appComponentsFactory->buildGlobalResponse(
    'OpeningHtml',
    0,
    $appComponentsFactory->buildOutputComponent(
        'Doctype',
        'Output',
        '<!DOCTYPE html>' . PHP_EOL,
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHtmlTag',
        'Output',
        '<html lang="en">' . PHP_EOL,
        0.1
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHeadTag',
        'Output',
        '<head>' . PHP_EOL,
        0.2
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Title',
        'Output',
        0.3,
        'helloUniverse',
        'Title.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Meta',
        'Output',
        0.4,
        'helloUniverse',
        'Meta.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Stylesheets',
        'Output',
        0.5,
        'helloUniverse',
        'Stylesheets.php'
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHeadTag',
        'Output',
        '</head>' . PHP_EOL,
        0.6
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Output',
        '<body>' . PHP_EOL,
        0.7
    ),
);

