<?php

$appComponentsFactory->buildGlobalResponse(
    'ClosingHtml',
    999999999999999999999999999,
    $closingBodyTag,
    $appComponentsFactory->buildOutputComponent(
        'ClosingHtmlTag',
        'Output',
        '</html>' . PHP_EOL,
        0.1
    ),
);

