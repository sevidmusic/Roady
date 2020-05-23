<?php

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\Factory\BaseComponentFactory;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\GlobalResponse;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

ini_set('display_errors', true);
require '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/***********/
/*** App ***/
/***********/
$domain = new Request(
    new Storable(
        'AppDomain',
        'TEMP',
        'TEMP'
    ),
    new Switchable()
);
$domain->import(['url' => 'http://dcms.dev/']);
$app = new App($domain, new Switchable());
$componentCrud = new ComponentCrud(
    new Storable(
        'ComponentCrud',
        $app->getLocation(),
        'ComponentCruds'
    ),
    new Switchable(),
    new Standard(
        new Storable(
            'StorageDriver',
            $app->getLocation(),
            'StorageDrivers'
        ),
        new Switchable()
    )
);
$baseComponentFactory = new BaseComponentFactory($app, $componentCrud);
/****************/
/*** Requests ***/
/****************/
$rootRequest = new Request(
    new Storable(
        'HomepageRootRequest',
        $app->getLocation(),
        'Requests'
    ),
    new Switchable()
);

$rootRequest->import(['url' => $domain->getUrl()]);

$indexRequest = new Request(
    new Storable(
        'HomepageIndexRequest',
        $app->getLocation(),
        'Requests'
    ),
    new Switchable()
);
$indexRequest->import(['url' => $domain->getUrl() . 'index.php']);

/*****************************/
/***** OUTPUT COMPONENTS *****/
/*****************************/
$htmlStart = $baseComponentFactory->buildOutputComponent('HtmlStart', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'), 0.0);
$htmlHeadStart = $baseComponentFactory->buildOutputComponent('HtmlHeadStart', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'), 1.0);
$htmlHeadStylesStart = $baseComponentFactory->buildOutputComponent('HtmlHeadStylesStart', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html'), 2.0);
$cssBgColorsCommon = $baseComponentFactory->buildOutputComponent('CommonBackgroundColors', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css'), 3.0);
$cssFontsCommon = $baseComponentFactory->buildOutputComponent('CommonFonts', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/fonts-common.css'), 3.0);
$cssDimensionsCommon = $baseComponentFactory->buildOutputComponent('CommonDimensions', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css'), 3.0);
$htmlHeadStylesEnd = $baseComponentFactory->buildOutputComponent('HtmlHeadStylesEnd', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'), 4.0);
$htmlHeadEnd = $baseComponentFactory->buildOutputComponent('HtmlHeadEnd', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'), 5.0);
$htmlBodyStart = $baseComponentFactory->buildOutputComponent('HtmlBodyStart', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'), 6.0);
$htmlMainMenu = $baseComponentFactory->buildOutputComponent('MainMenu', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'), 7.0);
$htmlContentWelcome = $baseComponentFactory->buildOutputComponent('Welcome', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/welcome.html'), 8.0);
$htmlBodyEnd = $baseComponentFactory->buildOutputComponent('HtmlBodyEnd', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'), 9.0);
$htmlEnd = $baseComponentFactory->buildOutputComponent('HtmlEnd', 'CommonOutput', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'), 10.0);
/***** StandardUITemplates *****/

$defaultUITemplate = new StandardUITemplate(
    new Storable(
        'HomepageUITemplate',
        $app->getLocation(),
        'UITemplates'
    ),
    new Switchable(),
    new Positionable(0)
);
// All the OutputComponents defined at the moment are same type so we
// only new to call addType() on one of them, if there were different
// types of OutputComponents used then each type would need to be added
// to be represented in the Template.
$defaultUITemplate->addType($htmlStart);


// Responses
$htmlStartResponse = new GlobalResponse(
    $app,
    new Switchable(),
    new Positionable(0)
);
$htmlStartResponse->addTemplateStorageInfo($defaultUITemplate);
$htmlStartResponse->addOutputComponentStorageInfo($htmlStart); // move to htmlStart
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStart); // move to htmlStart;
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesStart); // move to htmlStart
$htmlStartResponse->addOutputComponentStorageInfo($cssBgColorsCommon); // move to htmlStart;
$htmlStartResponse->addOutputComponentStorageInfo($cssFontsCommon); // move to htmlStart;
$htmlStartResponse->addOutputComponentStorageInfo($cssDimensionsCommon); // move to htmlStart;
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesEnd); // move to htmlStart
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadEnd); // move to htmlStart;
$htmlStartResponse->addOutputComponentStorageInfo($htmlBodyStart); // move to htmlStart;

$mainMenuResponse = new GlobalResponse(
    $app,
    new Switchable(),
    new Positionable(1)
);
$mainMenuResponse->addTemplateStorageInfo($defaultUITemplate);
$mainMenuResponse->addOutputComponentStorageInfo($htmlMainMenu);


$homeResponse = new Response(
    new Storable(
        'Homepage',
        $app->getLocation(),
        Response::RESPONSE_CONTAINER
    ),
    new Switchable(),
    new Positionable(2)
);
$homeResponse->addRequestStorageInfo($indexRequest);
$homeResponse->addRequestStorageInfo($rootRequest);
$homeResponse->addTemplateStorageInfo($defaultUITemplate);
$homeResponse->addOutputComponentStorageInfo($htmlContentWelcome);

$htmlEndResponse = new GlobalResponse(
    $app,
    new Switchable(),
    new Positionable(3)
);
$htmlEndResponse->addTemplateStorageInfo($defaultUITemplate);
$htmlEndResponse->addOutputComponentStorageInfo($htmlBodyEnd); // move to htmlEnd;
$htmlEndResponse->addOutputComponentStorageInfo($htmlEnd); // move to htmlEnd;




$components = [
    $app,
    $indexRequest,
    $rootRequest,
    $mainMenuResponse,
    $htmlMainMenu,
    $homeResponse,
    $htmlStartResponse,
    $htmlEndResponse,
    $htmlStart,
    $htmlHeadStart,
    $htmlHeadStylesStart,
    $cssBgColorsCommon,
    $cssFontsCommon,
    $cssDimensionsCommon,
    $htmlHeadStylesEnd,
    $htmlHeadEnd,
    $htmlBodyStart,
    $htmlContentWelcome,
    $htmlBodyEnd,
    $htmlEnd,
    $defaultUITemplate
];

foreach ($components as $component) {
    printf(
        "<p>Saving component %s to location <span style='color: purple;'>%s</span> in container <span style='color: green;'>%s</span></p>",
        $component->getName(),
        $component->getLocation(),
        $component->getContainer()
    );
    printf(
        "%s",
        ($componentCrud->create($component) === true ? "<p style=\"color: green;\">Saved successfully</p>" : "<p style=\"color: red;\">The component could not be saved</p>")
    );
}

