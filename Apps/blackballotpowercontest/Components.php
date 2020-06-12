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
use Extensions\Contests\core\classes\component\Actions\CreateSubmission;

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
$start = $appComponentsFactory->buildOutputComponent(
    'HtmlStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'),
    0.0
);

$headStart = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'),
    1.0
);

$headStylesStart = $appComponentsFactory->buildOutputComponent(
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
$headStylesEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadStylesEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'),
    4.0
);

$headEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlHeadEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'),
    5.0
);

$bodyStart = $appComponentsFactory->buildOutputComponent(
    'HtmlBodyStart',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'),
    6.0
);

$mainMenu = $appComponentsFactory->buildOutputComponent(
    'MainMenu',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'),
    0.0
);

$contestInfo = $appComponentsFactory->buildOutputComponent(
    'Welcome',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR .
        'htmlContent/welcome.html'),
    0.0
);

$createSubmissionForm = new CreateSubmission(
    $primaryFactory->buildStorable('CreateContestSubmissionForm', 'Forms'),
    $primaryFactory->buildSwitchable(),
    $primaryFactory->buildPositionable(0.0),
    __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/create-submission-form.html',
    $componentCrud
);

$bodyEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlBodyEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'),
    0.0
);

$end = $appComponentsFactory->buildOutputComponent(
    'HtmlEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
    1.0
);
/***** StandardUITemplates *****/

$templateForCreateSubmissionTypes = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('OutputComponentAndCreateSubmissionTemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$templateForCreateSubmissionTypes->addType($createSubmissionForm);

$templateForOutputComponentsTypes = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('OutputComponentTemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$templateForOutputComponentsTypes->addType($start);

// Responses
$startResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$startResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$startResponse->addOutputComponentStorageInfo($start);
$startResponse->addOutputComponentStorageInfo($headStart);
$startResponse->addOutputComponentStorageInfo($headStylesStart);
$startResponse->addOutputComponentStorageInfo($cssBgColorsCommon);
$startResponse->addOutputComponentStorageInfo($cssFontsCommon);
$startResponse->addOutputComponentStorageInfo($cssDimensionsCommon);
$startResponse->addOutputComponentStorageInfo($cssRenderingCommon);
$startResponse->addOutputComponentStorageInfo($headStylesEnd);
$startResponse->addOutputComponentStorageInfo($headEnd);
$startResponse->addOutputComponentStorageInfo($bodyStart);

$mainMenuResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);
$mainMenuResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$mainMenuResponse->addOutputComponentStorageInfo($mainMenu);


$contestInfoResponse = new Response(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'Homepage',
        Response::RESPONSE_CONTAINER
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(2)
);
$contestInfoResponse->addRequestStorageInfo($indexRequest);
$contestInfoResponse->addRequestStorageInfo($indexRequestHttp);
$contestInfoResponse->addRequestStorageInfo($rootRequest);
$contestInfoResponse->addRequestStorageInfo($rootRequestHttp);
$contestInfoResponse->addTemplateStorageInfo($templateForCreateSubmissionTypes);
$contestInfoResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$contestInfoResponse->addOutputComponentStorageInfo($contestInfo);
$contestInfoResponse->addOutputComponentStorageInfo($createSubmissionForm);

$endResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(3)
);
$endResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$endResponse->addOutputComponentStorageInfo($bodyEnd); // move to htmlEnd;
$endResponse->addOutputComponentStorageInfo($end); // move to htmlEnd;


$components = [
    $app,
    $templateForCreateSubmissionTypes,
    $templateForOutputComponentsTypes,
    $indexRequest,
    $indexRequestHttp,
    $rootRequest,
    $rootRequestHttp,
    $startResponse,
    $mainMenuResponse,
    $contestInfoResponse,
    $endResponse,
    $createSubmissionForm
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

