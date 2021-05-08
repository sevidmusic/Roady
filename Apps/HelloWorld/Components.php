<?php

/**
 * Components.php
 */

use DarlingDataManagementSystem\classes\utility\AppBuilder;

ini_set('display_errors', 'true');

require(
    strval(
        realpath(
            str_replace(
                'Apps' . DIRECTORY_SEPARATOR . strval(basename(__DIR__)),
                'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
                __DIR__
            )
        )
    )
);



AppBuilder::buildApp(AppBuilder::getAppsAppComponentsFactory(strval(basename(__DIR__)), (escapeshellarg($argv[1] ?? ''))));

