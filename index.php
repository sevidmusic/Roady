<?php

ini_set('display_errors', true);
require_once __DIR__ . DIRECTORY_SEPARATOR . '/Apps/WorkingDemo/Settings.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\component\Web\App;
$tempContainer = 'TEMP';
$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'TEMPORARY_COMPONENTS',
        $tempContainer
    ),
    new Switchable()
);
$expectedAppLocation = App::deriveNameLocationFromRequest($currentRequest);
var_dump($expectedAppLocation);
$crud = new ComponentCrud(
    new Storable(
        'IndexCrud',
        $expectedAppLocation,
        $tempContainer
    ),
    new Switchable(),
    new Standard(
        new Storable(
            'StandardStorageDriver',
            $expectedAppLocation,
            $tempContainer
        ),
        new Switchable()
    )
);

$router = new Router(
    new Storable(
        'Router',
        $expectedAppLocation,
        $tempContainer
    ),
    new Switchable(),
    $currentRequest,
    $crud
);

$userInterface = new StandardUI(
    new Storable(
        'UserInterface',
        $expectedAppLocation,
        $tempContainer
    ),
    new Switchable(),
    new Positionable(),
    $router,
    $expectedAppLocation,
    Response::RESPONSE_CONTAINER
);

echo $userInterface->getOutput();
?>
<!-- Darling Cms -->
