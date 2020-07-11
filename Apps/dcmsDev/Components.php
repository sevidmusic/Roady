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

// @todo Implemnt as static method of AppComponentsFactory
function defaults(Request $domain): array {
    $primaryFactory = new PrimaryFactory(new App($domain, new Switchable()));

    $componentCrud = new ComponentCrud(
        $primaryFactory->buildStorable('Crud', 'Cruds'),
        $primaryFactory->buildSwitchable(),
        new Standard(
            $primaryFactory->buildStorable('StorageDriver', 'StorageDrivers'),
            $primaryFactory->buildSwitchable()
        )
    );
    $storedComponentRegistry = new StoredComponentRegistry(
        $primaryFactory->buildStorable(
            'AppComponentsRegistry',
            'StoredComponentRegistries'
        ),
        $componentCrud
    );
    return [
        $primaryFactory,
        $componentCrud,
        $storedComponentRegistry
    ];
}

define('REQUEST_CONTAINER', 'Requests');

$domain = new Request(
    new Storable(
        'Domain',
        'dcmsdev',
        REQUEST_CONTAINER
    ),
    new Switchable()
);
$domain->import(['url' => 'http://dcms.dev/']);

$appComponentsFactory = new AppComponentsFactory(...defaults($domain));

$rootRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'RootRequest',
        REQUEST_CONTAINER
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);

$rootRequest->import(['url' => $domain->getUrl()]);

$indexRequest = new Request(
    $appComponentsFactory->getPrimaryFactory()->buildStorable(
        'HomepageRequest',
        REQUEST_CONTAINER
    ),
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable()
);
$indexRequest->import(['url' => $domain->getUrl() . 'index.php']);

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

$htmlEnd = $appComponentsFactory->buildOutputComponent(
    'HtmlEnd',
    'CommonOutput',
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'html/html-end.html'),
    10.0
);

$defaultUITemplate = $appComponentsFactory->buildStandardUITemplate(
    'defaultUITemplate',
    'UITemplates',
    0,
    $htmlEnd,
    $htmlContentCreateSubmissionForm
);

$defaultGlobalUITemplate = $appComponentsFactory->buildStandardUITemplate(
    'defaultGlobalUITemplate',
    'UITemplates',
    0,
    $htmlEnd,
);

$htmlStartResponse = new GlobalResponse(
    $appComponentsFactory->getPrimaryFactory()->export()['app'],
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(0)
);
$htmlStartResponse->addTemplateStorageInfo($defaultGlobalUITemplate);
$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-start.html'
        ),
        0.0
    )
);
$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-start.html'
        ),
        1.0
    )
);
$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-start.html'
        ),
        2.0
    )
);
$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'CommonBackgroundColors',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/background-colors-common.css'
        ),
        3.0
    )
);

$htmlStartResponse->addOutputComponentStorageInfo(
    $cssFontsCommon = $appComponentsFactory->buildOutputComponent(
        'CommonFonts',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/fonts-common.css'
        ),
        3.0
    )
);

$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'CommonDimensions',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'css/dimensions-common.css'
        ),
        3.0
    )
);

$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadStylesEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-styles-end.html'
        ),
        4.0
    )
);

$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlHeadEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-head-common-end.html'
        ),
        5.0
    )
);

$htmlStartResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyStart',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-start.html'
        ),
        6.0
    )
);

$mainMenuResponse = new GlobalResponse(
    $appComponentsFactory->getPrimaryFactory()->export()['app'],
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(1)
);

$mainMenuResponse->addTemplateStorageInfo($defaultGlobalUITemplate);

$mainMenuResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'MainMenu',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'htmlContent/main-menu.html'
        ),
        7.0
    )
);


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
$homeResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'Welcome',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR .
            'htmlContent/welcome.html'
        ),
        8.0
    )
);
$homeResponse->addOutputComponentStorageInfo($htmlContentCreateSubmissionForm);

$htmlEndResponse = new GlobalResponse(
    $appComponentsFactory->getPrimaryFactory()->export()['app'],
    $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
    $appComponentsFactory->getPrimaryFactory()->buildPositionable(3)
);
$htmlEndResponse->addTemplateStorageInfo($defaultGlobalUITemplate);
$htmlEndResponse->addOutputComponentStorageInfo(
    $appComponentsFactory->buildOutputComponent(
        'HtmlBodyEnd',
        'CommonOutput',
        file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'html/html-body-common-end.html'
        ),
        9.0
    )
);
$htmlEndResponse->addOutputComponentStorageInfo($htmlEnd);


$components = [
    $appComponentsFactory->getPrimaryFactory()->export()['app'],
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
    usleep(90000);
    printf(
        "%s%s",
        PHP_EOL,
        ($appComponentsFactory->getComponentCrud()->create($component) === true ? "Saved successfully" : "The component could not be saved")
    );
    printf("%s", PHP_EOL);
}

foreach(
    $appComponentsFactory->getStoredComponentRegistry()->getRegistry()
    as
    $storable
)
{
    printf(
        '%sBuilt component %s and saved to location %s in container %s.%sComponent Id: %s%s',
        PHP_EOL,
        $storable->getName(),
        $storable->getLocation(),
        $storable->getContainer(),
        PHP_EOL,
        $storable->getUniqueId(),
        PHP_EOL
    );
}
