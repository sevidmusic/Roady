<?php

ini_set('display_errors', true);
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\classes\component\UserInterface\StandardUI;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;

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
    new StorageDriver(
        $primaryFactory->buildStorable('AppStorageDriver', 'Index'),
        $primaryFactory->buildSwitchable()
    )
);

$router = new Router(
    $primaryFactory->buildStorable('AppRouter', 'Index'),
    $primaryFactory->buildSwitchable(),
    $currentRequest, // @todo This should be passed App
    $crud
);
try {
    $userInterface = new StandardUI(
        $primaryFactory->buildStorable('AppUI', 'Index'),
        $primaryFactory->buildSwitchable(),
        $primaryFactory->buildPositionable(0),
        $router,
    );

    echo $userInterface->getOutput();
} catch (RuntimeException $runtimeException) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Your request could not be processed.</title>
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
    <p>Sorry, the you request you made is not valid. Please try again later.</p>
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

