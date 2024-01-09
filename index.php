<?php

# Roady's index.php

use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleOutputRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\configuration\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyRoutes\classes\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\classes\requests\Request;
use \Darling\RoadyRoutingUtilities\classes\utilities\routing\Router;
use \Darling\RoadyUIUtilities\ui\RoadyUI;
use \Darling\Roady\api\RoadyFileSystemPaths;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

$roadyUI = new RoadyUI(
    new Router(
        new Request(),
        new ListingOfDirectoryOfRoadyModules(
            RoadyFileSystemPaths::pathToRoadysModulesDirectory()
        ),
        new ModuleCSSRouteDeterminator(),
        new ModuleJSRouteDeterminator(),
        new ModuleOutputRouteDeterminator(),
        new ModuleRoutesJsonConfigurationReader(),
    ),
    new RouteCollectionSorter(),
);

echo $roadyUI->__toString();

echo '<!-- Powered by [Roady](https://github.com/sevidmusic/Roady) -->

