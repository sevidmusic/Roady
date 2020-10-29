<?php

$appComponentsFactory->buildGlobalResponse(
    'DoctypeOpenHtmlOpenHead',
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
        ),
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
);

