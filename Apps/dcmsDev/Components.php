<?php

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\App;
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
$htmlStart = new OutputComponent(
    new Storable(
        'HtmlStart',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(0.0)
);
$htmlStart->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html')]);

$htmlHeadStart = new OutputComponent(
    new Storable(
        'HtmlHeadStart',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(1.0)
);
$htmlHeadStart->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html')]);

$htmlHeadStylesStart = new OutputComponent(
    new Storable(
        'HtmlHeadStylesStart',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(2.0)
);
$htmlHeadStylesStart->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html')]);

$cssBgColorsCommon = new OutputComponent(
    new Storable(
        'CommonBackgroundColors',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(3.0)
);
$cssBgColorsCommon->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css')]);

$cssFontsCommon = new OutputComponent(
    new Storable(
        'CommonFonts',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(3.0)
);
$cssFontsCommon->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/fonts-common.css')]);

$cssDimensionsCommon = new OutputComponent(
    new Storable(
        'CommonDimensions',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(3.0)
);
$cssDimensionsCommon->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css')]);

$htmlHeadStylesEnd = new OutputComponent(
    new Storable(
        'HtmlHeadStylesStart',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(4.0)
);
$htmlHeadStylesEnd->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html')]);

$htmlHeadEnd = new OutputComponent(
    new Storable(
        'HtmlHeadEnd',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(5.0)
);
$htmlHeadEnd->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html')]);

$htmlBodyStart = new OutputComponent(
    new Storable(
        'HtmlBodyStart',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(6.0)
);
$htmlBodyStart->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html')]);

$htmlContentWelcome = new OutputComponent(
    new Storable(
        'Welcome',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(7.0)
);
$htmlContentWelcome->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/welcome.html')]);

$htmlBodyEnd = new OutputComponent(
    new Storable(
        'HtmlBodyEnd',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(8.0)
);
$htmlBodyEnd->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html')]);

$htmlEnd = new OutputComponent(
    new Storable(
        'HtmlEnd',
        $app->getLocation(),
        'CommonOutput'
    ),
    new Switchable(),
    new Positionable(9.0)
);
$htmlEnd->import(['output' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html')]);

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
$homeResponse = new Response(
    new Storable(
        'Homepage',
        $app->getLocation(),
        Response::RESPONSE_CONTAINER
    ),
    new Switchable(),
    new Positionable(5)
);
$homeResponse->addRequestStorageInfo($indexRequest);
$homeResponse->addRequestStorageInfo($rootRequest);
$homeResponse->addTemplateStorageInfo($defaultUITemplate);
$homeResponse->addOutputComponentStorageInfo($htmlContentWelcome);

$globalResponse = new \DarlingCms\classes\component\Web\Routing\GlobalResponse(
    $app,
    new Switchable()
);
$globalResponse->addTemplateStorageInfo($defaultUITemplate);
$globalResponse->addOutputComponentStorageInfo($htmlStart); // move to global
$globalResponse->addOutputComponentStorageInfo($htmlHeadStart); // move to global;
$globalResponse->addOutputComponentStorageInfo($htmlHeadStylesStart); // move to global
$globalResponse->addOutputComponentStorageInfo($cssBgColorsCommon); // move to global;
$globalResponse->addOutputComponentStorageInfo($cssFontsCommon); // move to global;
$globalResponse->addOutputComponentStorageInfo($cssDimensionsCommon); // move to global;
$globalResponse->addOutputComponentStorageInfo($htmlHeadStylesEnd); // move to global
$globalResponse->addOutputComponentStorageInfo($htmlHeadEnd); // move to global;
$globalResponse->addOutputComponentStorageInfo($htmlBodyStart); // move to global;
$globalResponse->addOutputComponentStorageInfo($htmlBodyEnd); // move to global;
$globalResponse->addOutputComponentStorageInfo($htmlEnd); // move to global;


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

$components = [
    $app,
    $indexRequest,
    $rootRequest,
    $homeResponse,
    $globalResponse,
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

