<?php

$appComponentsFactory->buildGlobalResponse(
    'ClosingHtml',
    999999999999999999999999999,
    $appComponentsFactory->buildOutputComponent(
        'ClosingBodyTag',
        'Output',
        '</body>' . PHP_EOL,
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHtmlTag',
        'Output',
        '</html>' . PHP_EOL,
        0.1
    ),
);

