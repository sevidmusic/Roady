<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    0,
    $appComponentsFactory->buildOutputComponent(
        'Doctype',
        'Components',
        '<!DOCTYPE html>' . PHP_EOL,
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHtmlTag',
        'Components',
        '<html lang="en">' . PHP_EOL,
        0.1
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHeadTag',
        'Components',
        '<head>' . PHP_EOL,
        0.2
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Title',
        'Components',
        0.3,
        'helloUniverse',
        'Title.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Meta',
        'Components',
        0.4,
        'helloUniverse',
        'Meta.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Stylesheets',
        'Components',
        0.5,
        'helloUniverse',
        'Stylesheets.php'
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHeadTag',
        'Components',
        '</head>' . PHP_EOL,
        0.6
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Components',
        '<body style="background: #000000;">' . PHP_EOL,
        0.7
    ),
);

