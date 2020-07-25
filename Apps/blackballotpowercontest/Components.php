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

require(
    '..' .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

define('REQUEST_CONTAINER', 'Requests');

$domain = AppComponentsFactory::buildDomain('https://blackballotpowercontest.local/');

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs($domain)
);

$appComponentsFactory->getComponentCrud()->create(
    $appComponentsFactory->getPrimaryFactory()->export()['app']
);
$appComponentsFactory->getStoredComponentRegistry()->registerComponent(
    $appComponentsFactory->getPrimaryFactory()->export()['app']
);

$appComponentsFactory->getComponentCrud()->create($domain);
$appComponentsFactory->getStoredComponentRegistry()->registerComponent($domain);

$htmlContentCreateSubmissionForm = new CreateSubmission(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'CreateContestSubmissionForm',
        'ContestSubmissions'
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(8.1),
    __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/devForm.html',
    $appComponentsFactory->getComponentCrud()
);
$appComponentsFactory->getComponentCrud()->create($htmlContentCreateSubmissionForm);
$appComponentsFactory->getStoredComponentRegistry()->registerComponent(
    $htmlContentCreateSubmissionForm
);

$appComponentsFactory->buildGlobalResponse(
    0,
    $appComponentsFactory->buildStandardUITemplate(
        'OutputComponentTemplate',
        'UITemplates',
        1,
        $appComponentsFactory->buildOutputComponent(
            'TemplOC',
            'Temp',
            '',
            0
        )
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlStart',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'),
        0.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStart',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'),
        1.0
     ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesStart',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html'),
        2.0
     ),
    $appComponentsFactory->buildOutputComponent(
        'CommonBackgroundColors',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css'),
        3.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'CommonFonts',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/text-common.css'),
        3.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'CommonDimensions',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css'),
        3.0
     ),
    $appComponentsFactory->buildOutputComponent(
        'CommonRendering',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'css/rendering-common.css'),
        3.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesEnd',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'),
        4.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadEnd',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'),
        5.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyStart',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'),
        6.0
    ),
);


/**
 * Requests: Represent requests that can be made to an App.
$rootRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('RootRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$rootRequest->import(['url' => $domain->getUrl()]);

$rootRequestHttp = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('RootRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$rootRequestHttp->import(['url' => str_replace('https', 'http', $domain->getUrl())]);

$indexRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequest->import(['url' => $domain->getUrl() . 'index.php']);

$indexRequestHttp = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('HomepageRequest', 'Requests'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequestHttp->import(['url' => str_replace('https', 'http', $domain->getUrl()) . 'index.php']);

/**
 * Output Components: Generate output for an App
$openingHeadTag = ;

$openingStylesTag = ;

$cssBgColorsCommon = ;

$cssFontsCommon = ;

$cssDimensionsCommon = ;

$cssRenderingCommon = ;
$closingStyleTag = ;

$closingHeadTag = ;

$openingBodyTag = ;

$mainMenuAndBanner = $appComponentsFactory->buildOutputComponent(
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

$closingCommonPageContainerDivAndClosingBodyTag = $appComponentsFactory->buildOutputComponent(
    'HtmlBodyEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'),
    0.0
);

$closingHtmlTag = $appComponentsFactory->buildOutputComponent(
    'HtmlEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
    1.0
);

$templateForCreateSubmissionTypes = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('CreateSubmissionTemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(5)
);
$templateForCreateSubmissionTypes->addType($createSubmissionForm);

$templateForOutputComponentsTypes = new StandardUITemplate(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('OutputComponentTemplate', 'UITemplates'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);
$templateForOutputComponentsTypes->addType($doctypeAndOpeningHtmlTag);

// Responses
$mainMenuResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);
$mainMenuResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$mainMenuResponse->addOutputComponentStorageInfo($mainMenuAndBanner);


$homepageMainContentResponse = new Response(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'Homepage',
        Response::RESPONSE_CONTAINER
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(2)
);
$homepageMainContentResponse->addRequestStorageInfo($indexRequest);
$homepageMainContentResponse->addRequestStorageInfo($indexRequestHttp);
$homepageMainContentResponse->addRequestStorageInfo($rootRequest);
$homepageMainContentResponse->addRequestStorageInfo($rootRequestHttp);
$homepageMainContentResponse->addTemplateStorageInfo($templateForCreateSubmissionTypes);
$homepageMainContentResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$homepageMainContentResponse->addOutputComponentStorageInfo($contestInfo);
$homepageMainContentResponse->addOutputComponentStorageInfo($createSubmissionForm);

$endResponse = new GlobalResponse(
    $app,
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(3)
);
$endResponse->addTemplateStorageInfo($templateForOutputComponentsTypes);
$endResponse->addOutputComponentStorageInfo($closingCommonPageContainerDivAndClosingBodyTag); // move to htmlEnd;
$endResponse->addOutputComponentStorageInfo($closingHtmlTag); // move to htmlEnd;


$components = [
    $app,
    $templateForCreateSubmissionTypes,
    $templateForOutputComponentsTypes,
    $indexRequest,
    $indexRequestHttp,
    $rootRequest,
    $rootRequestHttp,
    $openingHtmlResponse,
    $mainMenuResponse,
    $homepageMainContentResponse,
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
 */

foreach(
    $appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents()
    as
    $storable
)
{
    printf(
        '%sBuilt component %s:%s    Name: %s%s    UniqueId: %s%s    Type: %s%s    Location: %s%s    Container: %s%s',
        PHP_EOL,
        $storable->getName(),
        PHP_EOL,
        $storable->getName(),
        PHP_EOL,
        $storable->getUniqueId(),
        PHP_EOL,
        $storable->getType(),
        PHP_EOL,
        $storable->getLocation(),
        PHP_EOL,
        $storable->getContainer(),
        PHP_EOL
    );
    sleep(5);
}


