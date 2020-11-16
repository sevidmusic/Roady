<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;

$appComponentsFactory->buildResponse(
    'OutputComponentOverview',
    2,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'OutputComponentOverviewRequest',
        Request::class,
        $appComponentsFactory->getLocation(),
        'Requests'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'OutputComponentOverview',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
);

