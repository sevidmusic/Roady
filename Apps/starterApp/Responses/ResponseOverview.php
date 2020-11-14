<?php

$appComponentsFactory->buildResponse(
    'ResponseOverview',
    3,
    $responseOverviewRequest,
    $appComponentsFactory->buildDynamicOutputComponent(
        'ResponseOverview',
        'Output',
        0,
        'starterApp',
        'ResponseOverview.php'
    ),
);

