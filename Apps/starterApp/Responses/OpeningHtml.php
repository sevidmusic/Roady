<?php

use DarlingDataManagementSystem\classes\component\OutputComponent;

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
    $openingHeadTag,
    $title,
    $meta,
    $stylesheets,
    $closingHeadTag,
    $openingBodyTag,
);

