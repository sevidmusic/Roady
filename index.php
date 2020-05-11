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

$tempContainer = 'TEMP';
//$devLocation = '1921683310';
$devLocation = 'dcmsdev';
$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'TEMPORARY_COMPONENTS',
        $tempContainer
    ),
    new Switchable()
);
var_dump(preg_replace("/[^A-Za-z0-9]/", '', parse_url($currentRequest->getUrl(), PHP_URL_HOST)));

$crud = new ComponentCrud(
    new Storable(
        'IndexCrud',
        $devLocation,
        $tempContainer
    ),
    new Switchable(),
    new Standard(
        new Storable(
            'StandardStorageDriver',
            $devLocation,
            $tempContainer
        ),
        new Switchable()
    )
);

$router = new Router(
    new Storable(
        'Router',
        $devLocation,
        $tempContainer
    ),
    new Switchable(),
    $currentRequest,
    $crud
);

$userInterface = new StandardUI(
    new Storable(
        'UserInterface',
        $devLocation,
        $tempContainer
    ),
    new Switchable(),
    new Positionable(),
    $router,
    $devLocation,
    Response::RESPONSE_CONTAINER
);

echo $userInterface->getOutput();
?>
<!-- Darling Cms -->
