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

// Define App Domain
$domain = AppComponentsFactory::buildDomain('https://blackballotpowercontest.local/');

// Instantiate AppComponentsFactory
$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs($domain)
);

// Manually build "Create Submission" Action
$createSubmissionAction = new CreateSubmission(
    $appComponentsFactory->getPrimaryFactory()->buildStorable('CreateContestSubmissionForm', 'Forms'),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0.0),
    __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/create-submission-form.html',
    $appComponentsFactory->getComponentCrud()
);

// Create and Register "Create Submission" Action
$appComponentsFactory->getComponentCrud()->create($createSubmissionAction);
$appComponentsFactory->getStoredComponentRegistry()->registerComponent(
    $createSubmissionAction
);

// Build StandardUITemplate for OutputComponents
$templateForOutputComponentsTypes = $appComponentsFactory->buildStandardUITemplate(
    'OutputComponentTemplate',
    'UITemplates',
    1,
    $appComponentsFactory->buildOutputComponent(
        'TemplOC',
        'Temp',
        '',
        0
    )
);

// Build StandardUITemplate for CreateSubmission Actions
$templateForCreateSubmissionTypes = $appComponentsFactory->buildStandardUITemplate(
    'CreateSubmissionTemplate',
    'UITemplates',
    5,
    $createSubmissionAction
);

// Build Opening Html Respnse
$appComponentsFactory->buildGlobalResponse(
    0,
    $templateForOutputComponentsTypes,
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

// Main menu Response
$appComponentsFactory->buildGlobalResponse(
    1,
    $templateForOutputComponentsTypes,
    $appComponentsFactory->buildOutputComponent(
        'MainMenuAndBanner',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'),
        0.0
    )
);

// Build Homepage Response
$appComponentsFactory->buildResponse(
    'Homepage',
    2,
    $appComponentsFactory->buildRequest(
        'RootRequest',
        'Requests',
        $domain->getUrl()
    ),
    $appComponentsFactory->buildRequest(
        'RootHttpRequest',
        'Requests',
        str_replace('https', 'http', $domain->getUrl())
    ),
    $appComponentsFactory->buildRequest(
        'IndexRequest',
        'Requests',
        $domain->getUrl() . 'index.php'
    ),
    $appComponentsFactory->buildRequest(
        'IndexHttpRequest',
        'Requests',
        str_replace('https', 'http', $domain->getUrl()) . 'index.php'
    ),
    $templateForOutputComponentsTypes,
    $templateForCreateSubmissionTypes,
    $appComponentsFactory->buildOutputComponent(
        'Welcome',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR .
            'htmlContent/welcome.html'),
        0.0
    ),
    $createSubmissionAction
);

// Build Closing Html Global Response
$appComponentsFactory->buildGlobalResponse(
    3,
    $templateForOutputComponentsTypes,
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyEnd',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'),
        0.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlEnd',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
        1.0
    )
);

define("SHOW_LOG", 1);
define("SAVE_LOG", 2);

// buildLog($appComponentsFactory);
//buildLog($appComponentsFactory, SHOW_LOG);
//buildLog($appComponentsFactory, SAVE_LOG);
buildLog($appComponentsFactory, SHOW_LOG | SAVE_LOG);

function buildLog($appComponentsFactory, $flags): string {
    $buildLog = "";
    foreach(
        $appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents()
        as
        $storable
    )
    {
        $message = sprintf(
            '%sBuilt %s:%s    Name: %s%s    Container: %s%s    Location: %s%s    Type: %s%s    UniqueId: %s%s',
            PHP_EOL,
            $storable->getType(),
            PHP_EOL,
            "\033[42m" . $storable->getName() . "\033[0m",
            PHP_EOL,
            "\033[1;32m" . $storable->getContainer() . "\033[0m",
            PHP_EOL,
            "\033[44m" . $storable->getLocation() . "\033[0m",
            PHP_EOL,
            "\033[1;34m" . $storable->getType() . "\033[0m",
            PHP_EOL,
            "\033[46m" . $storable->getUniqueId() . "\033[0m",
            PHP_EOL
        );
        if($flags & SHOW_LOG) { echo $message; usleep(250000); }
        $buildLog .= $message;
    }
    if($flags & SAVE_LOG) {
        file_put_contents(__DIR__ . '/buildLog.txt', $buildLog);
    }
    return $buildLog;
}
