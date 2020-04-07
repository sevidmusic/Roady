<?php

ini_set('display_errors', true);
require_once __DIR__ . DIRECTORY_SEPARATOR . "DemoConstants.php";
require __DIR__ . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

$crud = new ComponentCrud(
    new Storable(
        DEMO_SITE_NAME . "Crud",
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . 'Cruds'
    ),
    new Switchable(),
    new Standard(
        new Storable(
            DEMO_SITE_NAME . "StandardStorageDriver",
            DEMO_SITE_NAME,
            DEMO_SITE_NAME . "StorageDrivers"
        ),
        new Switchable()
    )
);

$currentRequest = new \DarlingCms\classes\component\Web\Routing\Request(
    new Storable(
        DEMO_SITE_NAME . 'CurrentRequest',
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . 'Requests'
    ),
    new Switchable()
);

$router = new \DarlingCms\classes\component\Web\Routing\Router(
    new Storable(
        DEMO_SITE_NAME . 'Router',
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . 'Routers'
    ),
    new Switchable(),
    $currentRequest,
    $crud
);

$userInterface = new \DarlingCms\classes\component\UserInterface\StandardUI(
    new Storable(
        DEMO_SITE_NAME . 'UserInterface',
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . 'UserInterfaces'
    ),
    new Switchable(),
    new \DarlingCms\classes\primary\Positionable(),
    $router,
    DEMO_SITE_NAME,
    DEMO_SITE_RESPONSE_CONTAINER
);

echo $userInterface->getOutput();