<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;

$appComponentsFactory->buildResponse(
    'ResponseOverview',
    3,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'ResponseOverviewRequest',
        Request::class,
        $appComponentsFactory->getLocation(),
        'Requests'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'ResponseOverview',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
);

