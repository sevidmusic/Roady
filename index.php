<?php

ini_set('display_errors', true);
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\Factory\PrimaryFactory;
use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'Requests',
        'Index'
    ),
    new Switchable()
);

$app = new App($currentRequest, new Switchable());

$primaryFactory = new PrimaryFactory($app);

$crud = new ComponentCrud(
    $primaryFactory->buildStorable('AppCrud', 'Index'),
    $primaryFactory->buildSwitchable(),
    new Standard(
        $primaryFactory->buildStorable('AppStorageDriver', 'Index'),
        $primaryFactory->buildSwitchable()
    )
);

$router = new Router(
    $primaryFactory->buildStorable('AppRouter', 'Index'),
    $primaryFactory->buildSwitchable(),
    $currentRequest,
    $crud
);
try {
    $userInterface = new StandardUI(
        $primaryFactory->buildStorable('AppUI', 'Index'),
        $primaryFactory->buildSwitchable(),
        $primaryFactory->buildPositionable(0),
        $router,
        App::getRequestedApp($currentRequest, $crud)->getLocation(),
        Response::RESPONSE_CONTAINER
    );

    echo $userInterface->getOutput();
} catch (RuntimeException $runtimeException) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Requested App Is Unavailable</title>
        <style>
            body {
                background: #0a0800;
                color: #a68159;
            }

            .error {
                color: #732b3f;
            }
        </style>
    </head>
    <body>
    <h1>404 Not Found</h1>
    <p>Sorry, the App you requested could not be loaded at this time. Please try again later.</p>
    <ul>
        <li>App Name: <?php echo App::deriveNameLocationFromRequest($currentRequest); ?></li>
        <li class="error">Error Message: <?php echo $runtimeException->getMessage(); ?></li>
    </ul>
    </body>
    </html>
    <?php
}
?>
<!-- Powered by the Darling Cms | Currently Running App: <?php echo App::deriveNameLocationFromRequest($currentRequest); ?> -->

