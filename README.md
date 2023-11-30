# Roady

![alt text](https://raw.githubusercontent.com/sevidmusic/roady/roady/roadyLogo.png)

Note: This document is still being drafted, and will continue to
evolve over time.

### About

Roady is a PHP framework I have been developing for a long time.
At this point it is a passion project. I love coding, working
on Roady makes me happy.

The basic idea behind Roady is:

- The features of a website are implemented by individual Modules.
  For example, say my band used Roady to build our website, and we
  needed a music player. That music player would be implemented by
  a Module. If we needed a calender to show upcoming gigs, it would
  be implemented by a different Module.

- A Module may utilize javascript files, css files, html files, or php
  files to implement the features it provides.

- Modules define Routes which define the relationship between a Module
  Name, a collection of names that map to Request names, a collection
  of Named Positions that map to positions in a Roady HTML Template
  file, and a Relative Path to a file that determines a Routes's
  output.

- Roady's UI uses a Router and the Routes defined by installed Modules
  to determine the "output" that should be served in Response to a
  Request, and then uses the Routes defined by installed Modules in
  conjunction with a Roady HTML Template File to determine how the
  "output" should be organized.

- Multiple websites can run on a single installation of roady, each
  making use of one or more installed Roady Modules.

- Roady provides a command line utility that can be used for various
  administrative tasks, including installation and management of
  installed Roady Modules.

### Development of Roady v2.0

Roady v1.1.2 is the current stable version of roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

Roady v2.0 is a complete re-write of Roady that will build upon
roady's original design, though it will not be compatible with previous
versions of roady.

NOTE: At the moment I am using this file to plan the rest of
the re-write of `Roady2.0`.

######################################################################
############################ Roady 2.0 ###############################
######################################################################

# Draft/Design Notes

Pseudo code for how Roady's index.php might be implemented:

```
<?php

# Roady's index.php

use \Darling\PHPTextTypes\classes\strings\SafeText;
use \Darling\PHPTextTypes\classes\strings\SafeTextCollection;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\utilities\ModuleAuthoritiesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\classes\utilities\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\ModuleOutputRouteDeterminator
use \Darling\RoadyModuleUtilities\classes\utilities\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyRoutes\classes\collections\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\classes\requests\Request;
use \Darling\RoadyRoutingUtilities\classes\responses\Response;
use \Darling\RoadyRoutingUtilities\classes\utilities\Router;
use \Darling\RoadyTemplateUtilities\classes\paths\PathToDirectoryOfRoadyHtmlFileTemplates;
use \Darling\RoadyTemplateUtilities\classes\utilities\RoadyHTMLTemplateFileReader;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

$ui = new RoadyUI(
    new Router(
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
        new ModuleAuthoritiesJsonConfigurationReader(),
        new ModuleCSSRouteDeterminator(),
        new ModuleJSRouteDeterminator(),
        new ModuleOutputRouteDeterminator(),
        new ModuleRoutesJsonConfigurationReader(),
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
    new RoadyHTMLTemplateFileReader(),

);

echo $ui->__toString();

echo '<!-- Powered by [Roady](https://github.com/sevidmusic/Roady) -->

```

### Pseudo Router Definition

```
<?php

namespace \Darling\RoadyRoutingUtilities\interfaces\routing;

use \Darling\RoadyModuleUtilities\interfaces\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\utilities\ModuleAuthoritiesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\interfaces\utilities\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\ModuleOutputRouteDeterminator
use \Darling\RoadyModuleUtilities\interfaces\utilities\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyRoutingUtilities\interfaces\requests\Request;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

class Router
{

    public function __construct(
        private Request $request,
        private ListingOfDirectoryOfRoadyModules $listingOfDirectoryOfRoadyModules,
        private ModuleAuthoritiesJsonConfigurationReader $moduleAuthoritiesJsonConfigurationReader,
        private ModuleCSSRouteDeterminator $moduleCSSRouteDeterminator,
        private ModuleJSRouteDeterminator $moduleJSRouteDeterminator,
        pirvate ModuleOutputRouteDeterminator $moduleOutputRouteDeterminator,
        private ModuleRoutesJsonConfigurationReader $moduleRoutesJsonConfigurationReader,
    ) {}

    public function response(): Response
    {
        $definedRoutes = [];
        foreach(
            $this->listingOfDirectoryOfRoadyModules()
                 ->pathToRoadyModuleDirectoryCollection()
                 ->collection()
            as
            $pathToRoadyModuleDirectory
        ) {
            if(
                in_array(
                    $this->request()->url()->domain()->authority(),
                    $this->moduleAuthoritiesJsonConfigurationReader()
                         ->read($pathToRoadyModuleDirectory)
                         ->collection()
                )
            ) {
                foreach(
                    $this->moduleCSSRouteDeterminator()
                         ->determineCSSRoutes($pathToRoadyModuleDirectory)
                         ->collection()
                    as
                    $cssRoute
                ) {
                    $definedRoutes[] = $cssRoute;
                }
                foreach(
                    $this->moduleJSRouteDeterminator()
                         ->determineJSRoutes($pathToRoadyModuleDirectory)
                         ->collection()
                    as
                    $jsRoute
                ) {
                    $definedRoutes[] = $jsRoute;
                }
                foreach(
                    $this->moduleOutputRouteDeterminator()
                         ->determineOutputRoutes($pathToRoadyModuleDirectory)
                         ->collection()
                    as
                    $outputRoute
                ) {
                    $definedRoutes[] = $outputRoute;
                }
                foreach(
                    $this->moduleRoutesJsonConfigurationReader()
                         ->read($pathToRoadyModuleDirectory)
                         ->collection()
                    as
                    $configuredRoute
                ) {
                    $definedRoutes[] = $configuredRoute;
                }
            }
        }
        $responseRoutes = [];
        foreach($routes as $routeIndex => $route) {
            if(
                in_array($request->name(), $route->nameCollection()->collection())
                ||
                in_array(new Name(new Text('global')), $route->nameCollection()->collection())
            ) {
                $responseRoutes[] = $route;
            }
        }
        return new Response($router->request(), RouteCollection(...$responseRoutes));
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function listingOfDirectoryOfRoadyModules(): ListingOfDirectoryOfRoadyModules
    {
        return $this->listingOfDirectoryOfRoadyModules();
    }

    public function moduleAuthoritiesJsonConfigurationReader(): ModuleAuthoritiesJsonConfigurationReader
    {
        return $this->moduleAuthoritiesJsonConfigurationReader;
    }

    public function moduleCSSRouteDeterminator(): ModuleCSSRouteDeterminator
    {
        return $this->moduleCSSRouteDeterminator;
    }

    public function moduleJSRouteDeterminator(): ModuleJSRouteDeterminator
    {
        return $this->moduleJSRouteDeterminator;
    }

    public function moduleOutputRouteDeterminator(): ModuleOutputRouteDeterminator
    {
        return $this->moduleOutputRouteDeterminator;
    }

    public function moduleRoutesJsonConfigurationReader(): ModuleRoutesJsonConfigurationReader
    {
        return $this->moduleRoutesJsonConfigurationReader;
    }

}

```

### Pseudo RoadyUI Definition

```
<?php

namespace \Darling\ROadyUIUtilities\interfaces\ui;

use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\interfaces\strings\SafeText;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyRoutes\interfaces\collections\PositionNameCollection;
use \Darling\RoadyRoutes\interfaces\paths\RelativePath;
use \Darling\RoadyRoutes\interfaces\routes\Route;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\interfaces\routing\Router;
use \Darling\RoadyTemplateUtilities\classes\paths\PathToRoadyHTMLFileTemplate as PathToRoadyHTMLFileTemplateInstance;
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToDirectoryOfRoadyHTMLFileTemplates;
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToRoadyHTMLFileTemplate;
use \Darling\RoadyTemplateUtilities\interfaces\utilities\RoadyHTMLTemplateFileReader;
use Darling\PHPWebPaths\classes\paths\parts\url\Path;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

class RoadyUI
{

    public function __construct(
        private Router $this->router(),
        private PathToDirectoryOfRoadyHTMLFileTemplates $pathToDirectoryOfRoadyHTMLFileTemplates,
        private RouteCollectionSorter $routeCollectionSorter,
        private RoadyHTMLTemplateFileReader $roadyHTMLTemplateFileReader,
    ) {}

    public function render(): string
    {
        /** array<string, array<string, Route>> */
           $sortedRoutes = $this->routeCollectionSorter()
                                ->sortByNamedPosition(
                                    $this->router()
                                         ->response()
                                         ->routeCollection()
                                    );
        /** array<string, array<string, string>> */
        $routeOutputStrings = [];
        foreach($sortedRoutes as $routePositionName => $routes) {
            foreach($routes as $routePosition => $route) {
                $routeOutputStrings[$routePositionName] =
                $this->getRouteOutput($route);
            }
        }
        $renderedContent = $this->roadyHTMLTemplateFileReader()->read(
            $this->pathToRoadyHTMLFileTemplate()
        );
        foreach(
            $this->roadyHTMLTemplateFileReader()
                 ->positionNameCollection(
                     $this->pathToRoadyHTMLFileTemplate()
                 )->collection()
            as
            $positionName
        ) {
            $renderedContent = str_replace(
                '<' . $positionName->__toString() . '></' . $positionName->__toString() . '>',
                implode(PHP_EOL, ($routeOutputStrings[$positionName] ?? [])),
                $renderedContent,
            );
        }
        return $renderedContent;

    }

    public function router() Router
    {
        return $this->router;
    }

    public function pathToDirectoryOfRoadyHTMLFileTemplates() PathToDirectoryOfRoadyHTMLFileTemplates
    {
        return $this->pathToDirectoryOfRoadyHTMLFileTemplates;
    }

    public function routeCollectionSorter() RouteCollectionSorter
    {
        return $this->routeCollectionSorter;
    }

    public function roadyHTMLTemplateFileReader() RoadyHTMLTemplateFileReader
    {
        return $this->roadyHTMLTemplateFileReader;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    private function pathToRoadyHTMLFileTemplate(): PathToRoadyHTMLFileTemplate
    {
        return new PathToRoadyHTMLFileTemplateInstance(
            new Name(
                new Text($this->router()->request()->name() . '.html')
            ),
            $this->pathToDirectoryOfRoadyHTMLFileTemplates(),
        );
    }

    private function determinePathToModuleDirectory(Name $moduleName): PathToRoadyModuleDirectory
    {
        return new PathToRoadyModuleDirectory(
            $this->router()
                 ->listingOfDirectoryOfRoadyModules()
                 ->pathToDirectoryOfRoadyModules(),
            $moduleName
        );
    }

    private function determineRealPathToFileInModuleDirectory(
       Name $moduleName,
       RelativePath $relativePath
    ): PathToExistingFile
    {
        $pathToRoadyModuleDirectory = $this->determinePathToModuleDirectory($moduleName);
        $pathToFile = $pathToRoadyModuleDirectory->__toString() .
                      DIRECTORY_SEPARATOR .
                      $relativePath->__toString();
        $parts = explode(DIRECTORY_SEPARATOR, $pathToFile);
        $safeTextParts = [];
        foreach($parts as $part) {
            $safeTextParts[] = new SafeText($part);
        }
        return new PathToExistingFile(
            new SafeTextCollection(...$safeTextParts)
        );
    }

    private function getRouteOutput(Route $route): string
    {
        $targetFilePath = $this->determineRealPathToFileInModuleDirectory(
           $route->moduleName(), $route->relativePath()
        );
        if($this->fileIsAPhpFile($targetFilePath)) {
            ob_start();
            include($targetFilePath->__toString());
            return ob_get_clean();
        }
        if($this->fileIsACssFile($targetFilePath) {
            return '<link rel="stylesheet" type="text/css" href="' . $this->determineRouteWebPath($this->router()->request()->domain(), $route) . '" />';
        }
        if($this->fileIsAJsFile($targetFilePath) {
            return '<script type="text/javascript" src="' . $this->determineRouteWebPath($this->router()->request()->domain(), $route) . '"></script>';
        }
        return strval(file_get_contents($targetFilePath->__toString()));

    }

    private function fileIsAPhpFile(PathToExistingFile $pathToExistingFile): bool
    {
        return str_contains($pathToExistingFile->__toString(), '.php');
    }

    private function fileIsACssFile(PathToExistingFile $pathToExistingFile->__toString()): bool
    {
        return str_contains($pathToExistingFile->__toString(), '.css');
    }

    private function fileIsAJsFile(PathToExistingFile $pathToExistingFile): bool
    {
        return str_contains($pathToExistingFile, '.js');
    }

    private function determineRouteWebPath(Route $route): Url {
        return new Url(
            domain: $this->router()->request()->domain(),
            path: $this->determineRoutesUrlPath($route),
        );
    }

    private function determineRoutesUrlPath(Route $route): Path
    {
        $parts = explode(
            DIRECTORY_SEPARATOR,
            'modules' .
            DIRECTORY_SEPARATOR .
            $route->moduleName()->__toString() .
            DIRECTORY_SEPARATOR .
            $route->relativePath()->__toString()
        );
        $safeTextParts = [];
        foreach($parts as $part) {
            $safeTextParts[] = new SafeText($part);
        }
        return new Path(
            new SafeTextCollection(...$safeTextParts)
        );
    }

}

```

