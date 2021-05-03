<?php

/** YAY.php */

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;

$appComponentsFactory->buildGlobalResponse(
    'YAY',
    0,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'YES',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'OutputComponents'
    ),

);

