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

$welcomeMessage = new OutputComponent(
    new Storable(
        'HomepageWelcomeMessage',
        $app->getLocation(),
        'HomepageOutputComponents'
    ),
    new Switchable(),
    new Positionable(0)
);
$welcomeMessage->import(['output' => 'Welcome to the Darling Cms.']);

/***** StandardUITemplates *****/

$homepageUITemplate = new StandardUITemplate(
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
$homepageUITemplate->addType($welcomeMessage);


// Responses
$homeResponse = new Response(
    new Storable(
        'Homepage',
        $app->getLocation(),
        Response::RESPONSE_CONTAINER
    ),
    new Switchable()
);
$homeResponse->addRequestStorageInfo($indexRequest);
$homeResponse->addRequestStorageInfo($rootRequest);
$homeResponse->addTemplateStorageInfo($homepageUITemplate);
$homeResponse->addOutputComponentStorageInfo($welcomeMessage);


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
    $welcomeMessage,
    $homepageUITemplate
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

