<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;

$appComponentsFactory->buildGlobalResponse(
    'ClosingHtml',
    999999999999999999999999999,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'ClosingBodyTag',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'ClosingHtmlTag',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
);

