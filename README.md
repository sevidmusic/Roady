```
    ____                  __
   / __ \____  ____ _____/ /_  __
  / /_/ / __ \/ __ `/ __  / / / /
 / _, _/ /_/ / /_/ / /_/ / /_/ /
/_/ |_|\____/\__,_/\__,_/\__, /
                        /____/
```

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

- Modules define Routes which define the relationship between a Module
  Name, a collection of names that map to Request names, a collection
  of Named Positions that map to positions in a Roady HTML Template
  file, and a Relative Path to a file that determines a Routes's
  output.

- Roady's UI uses a Router and the Routes defined by installed Modules
  to determine the "output" that should be served in Response to a
  Request, and then uses the Routes returned by the Router's Response
  in conjunction with a Roady HTML Template File to determine how the
  "output" should be displayed.

- Multiple websites can run on a single installation of roady, each
  making use of one or more installed Roady Modules.

### Anatomy of a Module

Possible directory structure of a Roady Module, starting with
Module's root directory:

```

./:
authorities.json # defines authorities of the websites the module
                 # will run on, for example:

                 [
                     'localhost:8080',
                     'example.com',
                     'sub.domain.example.com'
                 ]

routes.json      # defines the Module's hard-coded Routes, for example:

                 [
                     'ModuleName',
                     ['homepage', 'another-requests-name'],
                     [['section-1', 1], ['section-2', 0]],
                     'relative/path/to/file/in/modules/directory'
                 ]

css              # The css directory is not required, but if it exists
                 # a Route will be defined for each file it contains

js               # The js directory is not required, but if it exists
                 # a Route will be defined for each file it contains

output           # The output directory is not required, but if it
                 # exists a Route will be defined for each file it
                 # contains

./css:
files-in-the-css-directory-will-have-a-Route-defined-for-them-dynamically-that-will-map-to-a-request-whose-name-matches-the-files-name-excluding-the-extension.php
global-files-will-be-dynamically-Routed-to-match-all-Requests.css

./js:
files-in-the-js-directory-will-have-a-Route-defined-for-them-dynamically-that-will-map-to-a-request-whose-name-matches-the-files-name-excluding-the-extension.php

./output:
files-in-the-output-directory-will-have-a-Route-defined-for-them-dynamically-that-will-map-to-a-request-whose-name-matches-the-files-name-excluding-the-extension.php

./misc-assets-this-directory-name-is-arbitrary
modules-may-contain-other-files-and-directories-that-may-be-nedded-for-the-module-to-function.txt

```

# Development of Roady v2.0

Roady v1.1.2 is the current stable version of roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

Roady v2.0 is a complete re-write of Roady that will be influenced by
roady's original design, but will not be compatible with previous
versions of roady.

NOTE: At the moment I am using this file to plan the rest of
the re-write of `Roady2.0`. This file will be revised to document
`Roady2.0` before `Roady2.0` is released.

### Todo:

The following is a list of namespaces for the interfaces that still need to be defined.

The namespace also indicates the library that the interface will be defined by.

```
### RoadyRoutes
use \Darling\RoadyRoutes\interfaces\routes\Route; # Needs new method `public function moduleName(): Name;`

### PHPFilesystemPaths
use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingDirectory;
use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingFile;

### RoadyModuleUtilities
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyModuleUtilities\interfaces\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\RoadyModuleFileSystemPathDeterminator
use \Darling\RoadyModuleUtilities\interfaces\utilities\configuration\ModuleAuthoritiesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleOutputRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\configuration\ModuleRoutesJsonConfigurationReader;


### RoadyRoutingUtilities
use \Darling\RoadyRoutingUtilities\interfaces\requests\Request;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\RouteInfo;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\routing\Router;

### RoadyTemplateUtilities
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToDirectoryOfRoadyHTMLFileTemplates;
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToRoadyHTMLFileTemplate;
use \Darling\RoadyTemplateUtilities\interfaces\utilities\RoadyHTMLTemplateFileReader;

### RoadyUIUtilities
use \Darling\RoadyUIUtilities\ui\RoadyUI;

### Roady
use \Darling\Roady\api\RoadyFileSystemPaths;


```

### Roady's API

Though Roady will primarily rely on other darling libraries for most
of it's functionality, Roady will define a simple API in the form of
classes that define static methods.

### Possible api class: \Darling\Roady\api\RoadyFileSystemPaths;

```
<?php

namespace \Darling\Roady\api;

use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingDirectory;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyTemplateUtilities\classes\paths\PathToDirectoryOfRoadyHTMLFileTemplates;


interface RoadyFileSystemPaths
{
    public static function pathToRoadysRootDirectory(): PathToExistingDirectory;
    public static function pathToRoadysModulesDirectory(): PathToDirectoryOfRoadyModules;
    public static function pathToRoadysTemplateDirectory(): PathToDirectoryOfRoadyHTMLFileTemplates;
}

```

# Draft/Design Notes

Pseudo code for how Roady's index.php might be implemented:

```
<?php

# Roady's index.php

use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\utilities\configuration\ModuleAuthoritiesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\determinators\ModuleOutputRouteDeterminator;
use \Darling\RoadyModuleUtilities\classes\utilities\configuration\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyRoutes\classes\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\classes\requests\Request;
use \Darling\RoadyRoutingUtilities\classes\utilities\routing\Router;
use \Darling\RoadyTemplateUtilities\classes\utilities\RoadyHTMLTemplateFileReader;
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
        new ModuleAuthoritiesJsonConfigurationReader(),
        new ModuleCSSRouteDeterminator(),
        new ModuleJSRouteDeterminator(),
        new ModuleOutputRouteDeterminator(),
        new ModuleRoutesJsonConfigurationReader(),
    ),
    RoadyFileSystemPaths::pathToRoadysTemplateDirectory(),
    new RouteCollectionSorter(),
    new RoadyHTMLTemplateFileReader(),

);

echo $roadyUI->__toString();

echo '<!-- Powered by [Roady](https://github.com/sevidmusic/Roady) -->

```

### Pseudo Router Definition

```
<?php

namespace \Darling\RoadyRoutingUtilities\interfaces\routing;

use \Darling\RoadyModuleUtilities\interfaces\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\utilities\configuration\ModuleAuthoritiesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\ModuleOutputRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\utilities\configuration\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyRoutes\interfaces\collections\RouteCollection;
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
        private ModuleOutputRouteDeterminator $moduleOutputRouteDeterminator,
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
        foreach($definedRoutes as $routeIndex => $route) {
            if(
                in_array($request->name(), $route->nameCollection()->collection())
                ||
                in_array(new Name(new Text('global')), $route->nameCollection()->collection())
            ) {
                $responseRoutes[] = $route;
            }
        }
        return new Response($router->request(), new RouteCollection(...$responseRoutes));
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

namespace \Darling\RoadyUIUtilities\interfaces\ui;

use Darling\PHPWebPaths\classes\paths\parts\url\Path;
use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\interfaces\strings\SafeText;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\RoadyModuleFileSystemPathDeterminator
use \Darling\RoadyRoutes\interfaces\paths\RelativePath;
use \Darling\RoadyRoutes\interfaces\routes\Route;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\routing\Router;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\RouteInfo;
use \Darling\RoadyTemplateUtilities\classes\paths\PathToRoadyHTMLFileTemplate as PathToRoadyHTMLFileTemplateInstance;
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToDirectoryOfRoadyHTMLFileTemplates;
use \Darling\RoadyTemplateUtilities\interfaces\paths\PathToRoadyHTMLFileTemplate;
use \Darling\RoadyTemplateUtilities\interfaces\utilities\RoadyHTMLTemplateFileReader;

/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

class RoadyUI
{

    /**
     * @var array<string, string> $previsoulyIncludedPHPOutput
     *                            Array of strings generated by
     *                            previously included php files
     *                            indexed by file path.
     */
    private array $previsoulyIncludedPHPOutput = [];

    /**
     * @var array<string, string> $previsoulyGeneratedCSSLinks
     *                            Array of <link> tags for css
     *                            stylesheets that have already
     *                            been processed indexed by
     *                            file path.
     */
    private array $previsoulyGeneratedCSSLinks = [];

    /**
     * @var array<string, string> $previsoulyGeneratedScriptTags
     *                            Array of <script> tags for js
     *                            files that have already been
     *                            been processed indexed by
     *                            file path.
     */
    private array $previsoulyGeneratedScriptTags = [];

    public function __construct(
        private Router $router,
        private PathToDirectoryOfRoadyHTMLFileTemplates $pathToDirectoryOfRoadyHTMLFileTemplates,
        private RouteCollectionSorter $routeCollectionSorter,
        private RoadyHTMLTemplateFileReader $roadyHTMLTemplateFileReader,
        private RoadyModuleFileSystemPathDeterminator $roadyModuleFileSystemPathDeterminator,
        private RouteInfo $routeInfo,
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
            $this->pathToRoadyHTMLFileTemplateForCurrentRequest()
        );
        foreach(
            $this->roadyHTMLTemplateFileReader()
                 ->positionNameCollection(
                     $this->pathToRoadyHTMLFileTemplateForCurrentRequest()
                 )->collection()
            as
            $positionName
        ) {
            $renderedContent = str_replace(
                '<' . $positionName->__toString() . '></' . $positionName->__toString() . '>',
                implode(PHP_EOL, ($routeOutputStrings[$positionName] ??[])),
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

    public function roadyModuleFileSystemPathDeterminator(): RoadyModuleFileSystemPathDeterminator
    {
        return $this->roadyModuleFileSystemPathDeterminator;
    }

    public function routeInfo(): RouteInfo
    {
        return $this->routeInfo;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    private function pathToRoadyHTMLFileTemplateForCurrentRequest(): PathToRoadyHTMLFileTemplate
    {
        return new PathToRoadyHTMLFileTemplateInstance(
            new Name(
                new Text($this->router()->request()->name() . '.html')
            ),
            $this->pathToDirectoryOfRoadyHTMLFileTemplates(),
        );
    }

    private function getRouteOutput(Route $route): string
    {
        $targetFilePath = $this->roadyModuleFileSystemPathDeterminator()
                               ->determinePathToFileInModuleDirectory(
                                   $this->listingOfDirectoryOfRoadyModules()
                                        ->pathToDirectoryOfRoadyModules(),
                          $route->moduleName(),
                          $route->relativePath()
        );
        if($this->fileIsAPhpFile($targetFilePath)) {
            /** If we already have the output, just use it */
            if(isset($this->previsoulyIncludedPHPOutput[$targetFilePath])) {
                return $this->previsoulyIncludedPHPOutput[$targetFilePath];
            }
            ob_start();
            include_once($targetFilePath->__toString());
            $this->previsoulyIncludedPHPOutput[$targetFilePath] = ob_get_clean();
            return $this->previsoulyIncludedPHPOutput[$targetFilePath];
        }
        if($this->fileIsACssFile($targetFilePath) {
            /** If we already have styesheet <link>, just use it */
            if(isset($this->previsoulyGeneratedCSSLinks[$targetFilePath])) {
                return $this->previsoulyGeneratedCSSLinks[$targetFilePath];
            }
            $this->previsoulyGeneratedCSSLinks[$targetFilePath] =
                '<link rel="stylesheet" ' .
                'type="text/css" ' .
                'href="' .
                $this->routeInfo()->determineRouteUrl(
                $this->router()->request()->domain(),
                $route
                ) .
                '" />';
            return $this->previsoulyGeneratedCSSLinks[$targetFilePath];
        }
        if($this->fileIsAJsFile($targetFilePath) {
            /** If we already have the js <script> tag, just use it */
            if(isset($this->previsoulyGeneratedScriptTags[$targetFilePath])) {
                return $this->previsoulyGeneratedScriptTags[$targetFilePath];
            }
            $this->previsoulyGeneratedScriptTags[$targetFilePath] = '<script type="text/javascript" ' .
                   'src="' . $this->routeInfo()->determineRouteUrl(
                       $this->router()->request()->domain(),
                       $route
            ) .
            '"></script>';
            return $this->previsoulyGeneratedScriptTags[$targetFilePath];
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

}

```

### Pseudo \Darling\RoadyRoutingUtilities\interfaces\utilities\RouteInfo

Defines methods that provide information about Roady Routes.

```
<?php

namespace \Darling\RoadyModuleUtilities\interfaces\utilities;

use \Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use \Darling\PHPTextTypes\interfaces\strings\SafeText;
use \Darling\PHPTextTypes\interfaces\strings\Text;
use \Darling\PHPWebPaths\classes\paths\Domain;
use \Darling\PHPWebPaths\classes\paths\parts\url\Path;
use \Darling\RoadyRoutes\interfaces\routes\Route;

interface RouteInfo
{

    public function determineRouteUrl(Domain $domain, Route $route): Url {
        return new Url(
            domain: $domain,
            path: $this->determineRoutesUrlPath($route),
        );
    }

    public function determineRoutesUrlPath(Route $route): Path
    {
        $parts = explode(
            'modules' .
            DIRECTORY_SEPARATOR .
            $route->moduleName()->__toString() .
            DIRECTORY_SEPARATOR .
            $route->relativePath()->__toString()
        );
        $safeTextParts = [];
        foreach($parts as $part) {
            $safeTextParts[] = new SafeText(new Text($part));
        }
        return new Path(
            new SafeTextCollection(...$safeTextParts)
        );
    }
}

```

### Pseudo \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\RoadyModuleFileSystemPathDeterminator;

Defines methods that provide information about Roady Module file
system paths.

```
<?php

namespace \Darling\RoadyModuleUtilities\interfaces\utilities;

use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\interfaces\strings\SafeText;
use \Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyRoutes\interfaces\paths\RelativePath;

interface RoadyModuleFileSystemPathDeterminator
{

    public function determinePathToFileInModuleDirectory(
        PathToDirectoryOfRoadyModules $pathToDirectoryOfRoadyModules,
        Name $moduleName,
        RelativePath $relativePath
    ): PathToExistingFile
    {
        $pathToRoadyModuleDirectory = new PathToRoadyModuleDirectory(
            $moduleName,
            $pathToDirectoryOfRoadyModules
        );
        $pathToFile = $pathToRoadyModuleDirectory->__toString() .
                      DIRECTORY_SEPARATOR .
                      $relativePath->__toString();
        $parts = explode(DIRECTORY_SEPARATOR, $pathToFile);
        $safeTextParts = [];
        foreach($parts as $part) {
            $safeTextParts[] = new SafeText(new Text($part));
        }
        return new PathToExistingFile(
            new SafeTextCollection(...$safeTextParts)
        );
    }

}

```

