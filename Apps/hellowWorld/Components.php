<?php

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
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


$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs(
    AppComponentsFactory::buildDomain('http://localhost:8888/')
)
);

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
$appComponentsFactory->getComponentCrud()->create(
    $htmlContentCreateSubmissionForm
);

$appComponentsFactory->getStoredComponentRegistry()->registerComponent(
    $htmlContentCreateSubmissionForm
);

$templateOC = $appComponentsFactory->buildOutputComponent(
    'HtmlEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
    10.0
);

$defaultUITemplate = $appComponentsFactory->buildStandardUITemplate(
    'defaultUITemplate',
    'UITemplates',
    0,
    $templateOC,
    $htmlContentCreateSubmissionForm
);

$defaultGlobalUITemplate = $appComponentsFactory->buildStandardUITemplate(
    'defaultGlobalUITemplate',
    'UITemplates',
    0,
    $templateOC,
);

$htmlStartResponse = $appComponentsFactory->buildGlobalResponse(
    'OpeningHtmlResponse',
    0,
    $defaultGlobalUITemplate,
    $appComponentsFactory->buildOutputComponent(
        'HtmlStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'
        ),
        0.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'
        ),
        1.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html'
        ),
        2.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'CommonBackgroundColors',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css'
        ),
        3.0
    ),
    $cssFontsCommon = $appComponentsFactory->buildOutputComponent(
        'CommonFonts',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/fonts-common.css'
        ),
        3.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'CommonDimensions',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css'
        ),
        3.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'
        ),
        4.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'
        ),
        5.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'
        ),
        6.0
    )
);

$mainMenuResponse = $appComponentsFactory->buildGlobalResponse(
    'MainMenuResponse',
    1,
    $defaultGlobalUITemplate,
    $appComponentsFactory->buildOutputComponent(
        'MainMenu',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'
        ),
        7.0
    )
);

$homeResponse = $appComponentsFactory->buildResponse(
    'Homepage',
    2,
    $appComponentsFactory->buildRequest(
        'HomepageRequest',
        REQUEST_CONTAINER,
        $appComponentsFactory->getAppDomain()->getUrl() . 'index.php'
    ),
    $appComponentsFactory->buildRequest(
        'RootRequest',
        REQUEST_CONTAINER,
        $appComponentsFactory->getAppDomain()->getUrl()
    ),
    $defaultUITemplate,
    $appComponentsFactory->buildOutputComponent(
        'Welcome',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR .
            'htmlContent/welcome.html'
        ),
        8.0
    ),
    $htmlContentCreateSubmissionForm
);

$htmlEndResponse = $appComponentsFactory->buildGlobalResponse(
    'ClosingHtmlResponse',
    3,
    $defaultGlobalUITemplate,
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'
        ),
        9.0
    ),
    $appComponentsFactory->buildOutputComponent(
        'HtmlEnd',
        'CommonOutput',
        file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
        10.0
    )
);

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);