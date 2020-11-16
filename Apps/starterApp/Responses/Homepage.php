<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;

$appComponentsFactory->buildResponse(
    'Homepage',
    2,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'RootRequest',
        Request::class,
        $appComponentsFactory->getLocation(),
        'Requests'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'HomepageRequest',
        Request::class,
        $appComponentsFactory->getLocation(),
        'Requests'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Welcome',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
);

