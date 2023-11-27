<?php

# Roady's index.php

use \Darling\PHPFilesystemPaths\classes\paths\PathToExistingDirectory;
use \Darling\PHPTextTypes\classes\strings\SafeText;
use \Darling\PHPTextTypes\classes\strings\SafeTextCollection;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyRoutes\classes\collections\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\classes\request\Request;
use \Darling\RoadyRoutingUtilities\classes\routing\Router;
use \Darling\RoadyTemplateUtilities\classes\paths\PathToDirectoryOfRoadyHtmlFileTemplates;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

$ui = new RoadyUI(
    new Router(
        /** @see comment ^ */
        new Request(),
        new ListingOfDirectoryOfRoadyModules(
            new PathToDirectoryOfRoadyModules(
                new PathToExisitingDirectory(
                    new SafeTextCollection(
                        new SafeText(new Text('path')),
                        new SafeText(new Text('to')),
                        new SafeText(new Text('roady')),
                        new SafeText(new Text('modules')),
                        new SafeText(new Text('directory'))
                    )
                )
            )
        ),
    ),
    new PathToDirectoryOfRoadyHtmlFileTemplates(
        new PathToExisitingDirectory(
            new SafeTextCollection(
                new SafeText(new Text('path')),
                new SafeText(new Text('to')),
                new SafeText(new Text('roady')),
                new SafeText(new Text('templates')),
                new SafeText(new Text('directory'))
            )
        )
    ),
    new RouteCollectionSorter(),
);

echo $ui->__toString();

echo '<!-- Powered by [Roady](https://github.com/sevidmusic/Roady) -->

