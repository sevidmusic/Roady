<?php

$appComponentsFactory->buildGlobalResponse(
    'LogoMainMenu',
    1,
    $appComponentsFactory->buildDynamicOutputComponent(
        'Logo',
        'Output',
        0,
        'starterApp',
        'Logo.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Main Menu',
        'Output',
        0.1,
        'starterApp',
        'MainMenu.php'
    ),
);

