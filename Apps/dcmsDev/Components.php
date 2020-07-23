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

$domain = AppComponentsFactory::buildDomain('http://dcms.dev/');

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs($domain)
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
        $domain->getUrl() . 'index.php'
    ),
    $domain,
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


$components = [
    $appComponentsFactory->getPrimaryFactory()->export()['app'],
    $domain,
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
