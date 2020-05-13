<?php

ini_set('display_errors', true);
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

$tempLocationContainer = 'TEMP';

$crud = new ComponentCrud(
    new Storable(
        'IndexCrud',
        $tempLocationContainer,
        $tempLocationContainer
    ),
    new Switchable(),
    new Standard(
        new Storable(
            'StandardStorageDriver',
            $tempLocationContainer,
            $tempLocationContainer
        ),
        new Switchable()
    )
);

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        $tempLocationContainer,
        $tempLocationContainer
    ),
    new Switchable()
);

$apps = $crud->readAll(
    App::deriveNameLocationFromRequest($currentRequest),
    App::APP_CONTAINER
);

switch (empty($apps[0])) {
    case true:
        die('The requested app has not been installed. Please install the "' . App::deriveNameLocationFromRequest($currentRequest) . '" app.');
    default:
        $app = $apps[0];
        if ($app->getState() === false) {
            die('The requested app ' . $app->getName() . ' is not available at this time');
        }
        break;
}

$router = new Router(
    new Storable(
        'Router',
        $tempLocationContainer,
        $tempLocationContainer
    ),
    new Switchable(),
    $currentRequest,
    $crud
);

$userInterface = new StandardUI(
    new Storable(
        'UserInterface',
        $tempLocationContainer,
        $tempLocationContainer
    ),
    new Switchable(),
    new Positionable(),
    $router,
    $app->getLocation(),
    Response::RESPONSE_CONTAINER
);

echo $userInterface->getOutput();
?>

<!-- Powered by the Darling Cms | Currently Running App: <?php echo App::deriveNameLocationFromRequest($currentRequest); ?> -->

