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
        'OutputComponent',
        'Components',
        '<div style="font-family: monospace; font-size: 3.2em; padding: 1em; background: #E5581A; color: #000000;"><a href="index.php">Home</a></div>',
        0
    )
);

