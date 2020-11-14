<?php

/**
 * LogoMainMenu.php
 * Responds to:
 * ALL
 */

$appComponentsFactory->buildGlobalResponse(
    'LogoMainMenu',
    1,
    $appComponentsFactory->buildDynamicOutputComponent(
        'Logo',
        'Output',
        0,
        'Documentation',
        'Logo.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Main Menu',
        'Output',
        0.1,
        'Documentation',
        'MainMenu.php'
    ),
);

