<?php

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;
use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;

ini_set('display_errors', true);

require(
    '..' .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs(
    AppComponentsFactory::buildDomain('http://localhost:8080')
    )
);

$appComponentsFactory->buildOutputComponent(
    'ClosingHtmlTag',
    'Output',
    '</html>' . PHP_EOL,
    0.1
);
$appComponentsFactory->buildOutputComponent(
    'ClosingBodyTag',
    'Output',
    '</body>' . PHP_EOL,
    0
);
$appComponentsFactory->buildDynamicOutputComponent(
    'Meta',
    'Output',
    0.4,
    'SingleConfigSite',
    'Meta.php'
);
$appComponentsFactory->buildOutputComponent(
    'OpeningHtmlTag',
    'Output',
    '<html lang="en">' . PHP_EOL,
    0.1
);
$appComponentsFactory->buildOutputComponent(
   'OpeningBodyTag',
    'Output',
    '<body>' . PHP_EOL,
    0.7
);
$appComponentsFactory->buildDynamicOutputComponent(
    'Welcome',
    'Output',
    0,
    'SingleConfigSite',
    'Welcome.php'
);
$appComponentsFactory->buildOutputComponent(
    'Doctype',
    'Output',
    '<!DOCTYPE html>' . PHP_EOL,
    0
);
$appComponentsFactory->buildDynamicOutputComponent(
    'OutputComponentOverview',
    'Output',
    0,
    'SingleConfigSite',
    'OutputComponentOverview.php'
);
$appComponentsFactory->buildDynamicOutputComponent(
    'Logo',
    'Output',
    0,
    'SingleConfigSite',
    'Logo.php'
);
$appComponentsFactory->buildDynamicOutputComponent(
    'Stylesheets',
    'Output',
    0.5,
    'SingleConfigSite',
    'Stylesheets.php'
);
$appComponentsFactory->buildDynamicOutputComponent(
    'Title',
    'Output',
    0.3,
    'SingleConfigSite',
    'Title.php'
);
$appComponentsFactory->buildOutputComponent(
    'ClosingHeadTag',
    'Output',
    '</head>' . PHP_EOL,
    0.6
);
$appComponentsFactory->buildDynamicOutputComponent(
    'MainMenu',
    'Output',
    0.1,
    'SingleConfigSite',
    'MainMenu.php'
);
$appComponentsFactory->buildOutputComponent(
    'OpeningHeadTag',
    'Output',
    '<head>' . PHP_EOL,
    0.2
);
$appComponentsFactory->buildDynamicOutputComponent(
    'ResponseOverview',
    'Output',
    0,
    'SingleConfigSite',
    'ResponseOverview.php'
);
$appComponentsFactory->buildRequest(
    'ResponseOverviewRequest',
    'Requests',
   $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?responseOverview',
);
$appComponentsFactory->buildRequest(
    'OutputComponentOverviewRequest',
    'Requests',
   $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?outputComponentOverview',
);
$appComponentsFactory->buildRequest(
    'HomepageRequest',
    'Requests',
   $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php',
);
$appComponentsFactory->buildRequest(
    'RootRequest',
    'Requests',
   $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/',
);
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
   $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'ClosingHeadTag',
        OutputComponent::class,
       $appComponentsFactory->getLocation(),
        'Output'
    ),
   $appComponentsFactory->getComponentCrud()->readByNameAndType(
        'OpeningBodyTag',
        OutputComponent::class,
       $appComponentsFactory->getLocation(),
        'Output'
    ),
);
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

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

