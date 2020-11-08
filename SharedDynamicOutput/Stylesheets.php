<?php

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\classes\component\UserInterface\ResponseUI;
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
    new JsonStorageDriver(
        $primaryFactory->buildStorable('AppStorageDriver', 'Index'),
        $primaryFactory->buildSwitchable()
    )
);
?>
    <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert One' rel='stylesheet'>
    <link href="./Apps/helloUniverse/css/rootElements.css" rel="stylesheet">
    <link href="./Apps/helloUniverse/css/textColors.css" rel="stylesheet">
    <link href="./Apps/helloUniverse/css/rendering.css" rel="stylesheet">
<?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    echo '<link href="./Apps/helloUniverse/css/animations.css" rel="stylesheet">' . PHP_EOL;
    echo '<!-- ' . $crud->getName() . $actual_link . ' -->';
?>

