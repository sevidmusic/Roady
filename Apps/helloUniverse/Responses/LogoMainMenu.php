<?php

$appComponentsFactory->buildGlobalResponse(
    'LogoMainMenu',
    1,
    $appComponentsFactory->buildDynamicOutputComponent(
        'Logo',
        'Components',
        0,
        'helloUniverse',
        'Logo.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Main Menu',
        'Components',
        0.1,
        'helloUniverse',
        'MainMenu.php'
    ),
);

