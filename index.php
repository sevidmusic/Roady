<?php

use \Darling\RoadyModuleUtilities\classes\configuration\ModuleRoutesJsonConfigurationReader as ModuleRoutesJsonConfigurationReaderInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleCSSRouteDeterminator as ModuleCSSRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleJSRouteDeterminator as ModuleJSRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleOutputRouteDeterminator as ModuleOutputRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\RoadyModuleFileSystemPathDeterminator as RoadyModuleFileSystemPathDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules as ListingOfDirectoryOfRoadyModulesInstance;
use \Darling\RoadyRoutes\classes\sorters\RouteCollectionSorter as RouteCollectionSorterInstance;
use \Darling\RoadyRoutingUtilities\classes\requests\Request as RequestInstance;
use \Darling\RoadyRoutingUtilities\classes\routers\Router as RouterInstance;
use \Darling\RoadyUIUtilities\classes\ui\html\UserInterface as UserInterfaceInstance;
use \Darling\Roady\classes\api\RoadyAPI;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$currentRequest = new RequestInstance();
$roadyModuleFileSystemPathDeterminator =
    new RoadyModuleFileSystemPathDeterminatorInstance();

$router = new RouterInstance(
    new ListingOfDirectoryOfRoadyModulesInstance(
        RoadyAPI::pathToDirectoryOfRoadyModules()
    ),
    new ModuleCSSRouteDeterminatorInstance(),
    new ModuleJSRouteDeterminatorInstance(),
    new ModuleOutputRouteDeterminatorInstance(),
    $roadyModuleFileSystemPathDeterminator,
    new ModuleRoutesJsonConfigurationReaderInstance(),
);

$response = $router->handleRequest($currentRequest);

$roadyUI = new UserInterfaceInstance(
    RoadyAPI::pathToDirectoryOfRoadyModules(),
    new RouteCollectionSorterInstance(),
    $roadyModuleFileSystemPathDeterminator,
);

echo $roadyUI->render($response);

