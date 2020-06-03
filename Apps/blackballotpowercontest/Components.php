<?php

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\Factory\App\AppComponentsFactory;
use DarlingCms\classes\component\Factory\PrimaryFactory;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\GlobalResponse;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

ini_set('display_errors', true);
require '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * App: Represents an application, for example: a website.
 */
$domain = new Request(
    new Storable(
        'AppDomain',
        'TEMP',
        'TEMP'
    ),
    new Switchable()
);
// Local domain
$domain->import(['url' => 'https://blackballotpowercontest.local/']);
// Production domain
//$domain->import(['url' => 'https://blackballotpowercontest.org/']);

$app = new App($domain, new Switchable());

/**
 * Primary Factory: Builds instances of primary objects:
 * Identifiable, Storable, Classifiable, Exportable,
 * Switchable, and Positionable
 */
$primaryFactory = new PrimaryFactory($app);

/**
 * Component Crud: Create, read, update, and delete components of various types from storage
 */
$componentCrud = new ComponentCrud(
    $primaryFactory->buildStorable('Crud', 'TEMP'),
    $primaryFactory->buildSwitchable(),
    new Standard(
        $primaryFactory->buildStorable('StorageDriver', 'TEMP'),
        $primaryFactory->buildSwitchable()
    )
);

/**
 * App Components Factory: Builds and stores various components for an App
 *
 * Note: At the moment only OutputComponents are supported, support for other
 * component types is planned for the future.
 */
$appComponentsFactory = new AppComponentsFactory(
    $primaryFactory,
    $componentCrud,
    new StoredComponentRegistry(
        $primaryFactory->buildStorable('AppComponentsRegistry', 'TEMP'),
        $componentCrud
    )
);

/**
 * Requests: Represent requests that can be made to an App.
 */
$rootRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('RootRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$rootRequest->import(['url' => $domain->getUrl()]);

$rootRequestHttp = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('RootRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$rootRequestHttp->import(['url' => str_replace('https','http', $domain->getUrl())]);

$indexRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequest->import(['url' => $domain->getUrl() . 'index.php']);

$indexRequestHttp = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequestHttp->import(['url' => str_replace('https','http', $domain->getUrl()) . 'index.php']);

/**
 * Output Components: Generate output for an App
 */
$htmlStart = $appComponentsFactory->buildOutputComponent(
    'HtmlStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'),
    0.0
);

$htmlHeadStart = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'),
    1.0
);

$htmlHeadStylesStart = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadStylesStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html'),
    2.0
);

$cssBgColorsCommon = $appComponentsFactory->buildOutputComponent(
    'CommonBackgroundColors',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css'),
    3.0
);

$cssFontsCommon = $appComponentsFactory->buildOutputComponent(
    'CommonFonts',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/text-common.css'),
    3.0
);

$cssDimensionsCommon = $appComponentsFactory->buildOutputComponent(
    'CommonDimensions',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css'),
    3.0
);

$cssRenderingCommon = $appComponentsFactory->buildOutputComponent(
    'CommonRendering',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/rendering-common.css'),
    3.0
);
$htmlHeadStylesEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadStylesEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'),
    4.0
);

$htmlHeadEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'),
    5.0
);

$htmlBodyStart = $appComponentsFactory->buildOutputComponent(
    'HtmlBodyStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'),
    6.0
);

$htmlMainMenu = $appComponentsFactory->buildOutputComponent(
    'MainMenu',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'),
    7.0
);

$htmlContentWelcome = $appComponentsFactory->buildOutputComponent(
    'Welcome',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR .
        'htmlContent/welcome.html'),
    8.0
);

$htmlBodyEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlBodyEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'),
    9.0
);

$htmlEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
    10.0
);
/***** StandardUITemplates *****/

$defaultUITemplate = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageUITemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
/* All the OutputComponents defined at the moment are same type so we
* only new to call addType() on one of them, if there were different
* types of OutputComponents used then each type would need to be added
* to be represented in the Template.
*/
$defaultUITemplate->addType($htmlStart);

// Responses
$htmlStartResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$htmlStartResponse->addTemplateStorageInfo($defaultUITemplate);
$htmlStartResponse->addOutputComponentStorageInfo($htmlStart);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStart);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesStart);
$htmlStartResponse->addOutputComponentStorageInfo($cssBgColorsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($cssFontsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($cssDimensionsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($cssRenderingCommon);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesEnd);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadEnd);
$htmlStartResponse->addOutputComponentStorageInfo($htmlBodyStart);

$mainMenuResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);
$mainMenuResponse->addTemplateStorageInfo($defaultUITemplate);
$mainMenuResponse->addOutputComponentStorageInfo($htmlMainMenu);


$homeResponse = new Response(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'Homepage',
        Response::RESPONSE_CONTAINER
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(2)
);
$homeResponse->addRequestStorageInfo($indexRequest);
$homeResponse->addRequestStorageInfo($indexRequestHttp);
$homeResponse->addRequestStorageInfo($rootRequest);
$homeResponse->addRequestStorageInfo($rootRequestHttp);
$homeResponse->addTemplateStorageInfo($defaultUITemplate);
$homeResponse->addOutputComponentStorageInfo($htmlContentWelcome);

$htmlEndResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(3)
);
$htmlEndResponse->addTemplateStorageInfo($defaultUITemplate);
$htmlEndResponse->addOutputComponentStorageInfo($htmlBodyEnd); // move to htmlEnd;
$htmlEndResponse->addOutputComponentStorageInfo($htmlEnd); // move to htmlEnd;


$components = [
    $app,
    $defaultUITemplate,
    $indexRequest,
    $indexRequestHttp,
    $rootRequest,
    $rootRequestHttp,
    $htmlStartResponse,
    $mainMenuResponse,
    $homeResponse,
    $htmlEndResponse,
];

foreach ($components as $component) {
    printf(
        "%sSaving component %s to location %s in container %s",
        PHP_EOL,
        $component->getName(),
        $component->getLocation(),
        $component->getContainer()
    );
    usleep(50000);
    printf(
        "%s%s",
        PHP_EOL,
        ($componentCrud->create($component) === true ? "Saved successfully" : "The component could not be saved")
    );
    usleep(100000);
    printf("%s", PHP_EOL);
}

