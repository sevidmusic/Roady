<?php

/** Foo.php */

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;

$appComponentsFactory->buildGlobalResponse(
    'Foo',
    0,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'HW',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'OutputComponents'
    ),

);

