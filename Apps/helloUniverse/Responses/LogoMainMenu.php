<?php

$appComponentsFactory->buildGlobalResponse(
    'LogoMainMenu',
    1,
    $appComponentsFactory->buildDynamicOutputComponent(
        'Logo',
        'Output',
        0,
        'helloUniverse',
        'Logo.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Main Menu',
        'Output',
        0.1,
        'helloUniverse',
        'MainMenu.php'
    ),
);

