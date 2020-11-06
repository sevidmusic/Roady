<?php

$appComponentsFactory->buildGlobalResponse(
    'ClosingHtml',
    0,
    $appComponentsFactory->buildOutputComponent(
        'ClosingBodyTag',
        'Components',
        '</body>' . PHP_EOL,
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHtmlTag',
        'Components',
        '</html>' . PHP_EOL,
        0.1
    ),
);

