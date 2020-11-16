<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;

$appComponentsFactory->buildGlobalResponse(
    'LogoMainMenu',
    1,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Logo',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'MainMenu',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
);

