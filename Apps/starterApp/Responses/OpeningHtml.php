<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;

$appComponentsFactory->buildGlobalResponse(
    'OpeningHtml',
    0,
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Doctype',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'OpeningHtmlTag',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'OpeningHeadTag',
        OutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Title',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Meta',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'Stylesheets',
        DynamicOutputComponent::class,
        $appComponentsFactory->getLocation(),
        'Output'
    ),
    $closingHeadTag,
    $openingBodyTag,
);

