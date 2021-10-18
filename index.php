<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use roady\classes\component\UserInterface\WebUI;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Router;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\utility\AppBuilder;

$currentRequest = new Request(new Storable('CurrentRequest', 'Requests', 'Index'), new Switchable());
$appComponentsFactory = AppBuilder::getAppsAppComponentsFactory(basename(__DIR__), $currentRequest->getUrl());

try {
    $userInterface = new WebUI(
        $appComponentsFactory->getPrimaryFactory()->buildStorable('AppUI', 'Index'),
        $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
        $appComponentsFactory->getPrimaryFactory()->buildPositionable(0),
        new Router(
            $appComponentsFactory->getPrimaryFactory()->buildStorable('AppRouter', 'Index'),
            $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
            $currentRequest,
            $appComponentsFactory->getComponentCrud()
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
        <li>App Name: <?php echo $appComponentsFactory->getApp()->getName(); ?></li>
        <li>Request: <?php echo $currentRequest->getUrl(); ?></li>
        <li class="error">Error Message: <?php echo $runtimeException->getMessage(); ?></li>
    </ul>
    </body>
    </html>
    <?php
}
?>
<!-- Powered by Roady  | https://github.com/sevidmusic/roady | https://darlingdata.tech -->
