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
        '<head><title>Darling Data Management System | Welcome</title></head>',
        2
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Components',
        '<body style="background: #000000;">',
        3
    ),
    $appComponentsFactory->buildOutputComponent(
        'HomeLink',
        'Components',
        '<div style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #E5581A; color: #000000;"><a href="index.php">Home</a></div>',
        4
    )
);


