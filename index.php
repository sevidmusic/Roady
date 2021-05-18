<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\classes\component\UserInterface\ResponseUI;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\utility\AppBuilder;
use DarlingDataManagementSystem\classes\utility\HtmlStructure;

$currentRequest = new Request(new Storable('CurrentRequest', 'Requests', 'Index'), new Switchable());
$appComonentsFactory = AppBuilder::getAppsAppComponentsFactory(strval(basename(__DIR__)), $currentRequest->getUrl());

HtmlStructure::enableHtmlStructure();

try {
    $userInterface = new ResponseUI(
        $appComonentsFactory->getPrimaryFactory()->buildStorable('AppUI', 'Index'),
        $appComonentsFactory->getPrimaryFactory()->buildSwitchable(),
        $appComonentsFactory->getPrimaryFactory()->buildPositionable(0),
        new Router(
            $appComonentsFactory->getPrimaryFactory()->buildStorable('AppRouter', 'Index'),
            $appComonentsFactory->getPrimaryFactory()->buildSwitchable(),
            $currentRequest,
            $appComonentsFactory->getComponentCrud()
        )
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
        <li>App Name: <?php echo $appComonentsFactory->getApp()->getName(); ?></li>
        <li>Request: <?php echo $currentRequest->getUrl(); ?></li>
        <li class="error">Error Message: <?php echo $runtimeException->getMessage(); ?></li>
    </ul>
    </body>
    </html>
    <?php
}
?>
<!-- Powered by the Darling Cms | Currently Running App: <?php echo App::deriveNameLocationFromRequest($currentRequest); ?> -->
