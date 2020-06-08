<?php /** @noinspection ALL */

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

$primaryFactory = new PrimaryFactory($app);

$componentCrud = new ComponentCrud(
    $primaryFactory->buildStorable('Crud', 'TEMP'),
    $primaryFactory->buildSwitchable(),
    new Standard(
        $primaryFactory->buildStorable('StorageDriver', 'TEMP'),
        $primaryFactory->buildSwitchable()
    )
);
$appComponentsFactory = new AppComponentsFactory(
    $primaryFactory,
    $componentCrud,
    new StoredComponentRegistry(
        $primaryFactory->buildStorable('AppComponentsRegistry', 'TEMP'),
        $componentCrud
    )
);

/****************/
/*** Requests ***/
/****************/
$rootRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('RootRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);

$rootRequest->import(['url' => $domain->getUrl()]);

$indexRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequest->import(['url' => $domain->getUrl() . 'index.php']);

/*****************************/
/***** OUTPUT COMPONENTS *****/
/*****************************/
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
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/fonts-common.css'),
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

$htmlContentCreateSubmissionForm = new CreateSubmission(
    $primaryFactory->buildStorable('CreateContestSubmissionForm', 'ContestSubmissions'),
    $primaryFactory->buildSwitchable(),
    $primaryFactory->buildPositionable(8.1),
    __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/create-submission-form.html',
    $componentCrud
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
    $appComponentsFactory->getPrimaryFactory()->buildStorable('defaultUITemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
// Add type core OutputComponent
$defaultUITemplate->addType($htmlStart);
// Add type extensions contests CreateSubmission
$defaultUITemplate->addType($htmlContentCreateSubmissionForm);

$defaultGlobalUITemplate = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('defaultGlobalUITemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
// Add type core OutputComponent
$defaultGlobalUITemplate->addType($htmlStart);

/**
 *  Responses
 */

$htmlStartResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$htmlStartResponse->addTemplateStorageInfo($defaultGlobalUITemplate);
$htmlStartResponse->addOutputComponentStorageInfo($htmlStart);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStart);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesStart);
$htmlStartResponse->addOutputComponentStorageInfo($cssBgColorsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($cssFontsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($cssDimensionsCommon);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadStylesEnd);
$htmlStartResponse->addOutputComponentStorageInfo($htmlHeadEnd);
$htmlStartResponse->addOutputComponentStorageInfo($htmlBodyStart);

$mainMenuResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);
$mainMenuResponse->addTemplateStorageInfo($defaultGlobalUITemplate);
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
$homeResponse->addRequestStorageInfo($rootRequest);
$homeResponse->addTemplateStorageInfo($defaultUITemplate);
$homeResponse->addOutputComponentStorageInfo($htmlContentWelcome);
$homeResponse->addOutputComponentStorageInfo($htmlContentCreateSubmissionForm);

$htmlEndResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(3)
);
$htmlEndResponse->addTemplateStorageInfo($defaultGlobalUITemplate);
$htmlEndResponse->addOutputComponentStorageInfo($htmlBodyEnd); // move to htmlEnd;
$htmlEndResponse->addOutputComponentStorageInfo($htmlEnd); // move to htmlEnd;


$components = [
    $app,
    $defaultUITemplate,
    $defaultGlobalUITemplate,
    $indexRequest,
    $rootRequest,
    $htmlStartResponse,
    $mainMenuResponse,
    $homeResponse,
    $htmlEndResponse,
    $htmlContentCreateSubmissionForm
];

foreach ($components as $component) {
    printf(
        "%sSaving component %s to location %s in container %s%sComponent Type: %s%sComponent Id: %s",
        PHP_EOL,
        $component->getName(),
        $component->getLocation(),
        $component->getContainer(),
        PHP_EOL,
        $component->getType(),
        PHP_EOL,
        $component->getUniqueId()
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

