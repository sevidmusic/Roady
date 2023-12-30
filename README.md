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

The following is an overview of how Roady works:

### Modules

- The features of a website are implemented by individual Modules.
  For example, say my band used Roady to build our website, and we
  needed a music player. That music player would be implemented by
  a Module. If we needed a calender to show upcoming gigs, it would
  be implemented by a different Module.

- Multiple websites can run on a single installation of Roady, each
  making use of one or more installed Roady Modules.

- Modules may define output in the form of `html` or `php` files to be
  served in response to various requests to a website's Domain.

- Modules may define `css` stylesheets and `javascript` files to define
  styles and implement additional functionality for a website.

- Modules may serve `css` , `javascript`, and `output` to a website
  via the Routes defined in a `json` file which is named after
  the website's Domain's Authority.

  For example, `sub.example.com.8080.json` would be the name of the
  file used to define Routes for a website with the following
  Domain:

       https://sub.example.com:8080/
       \___/   \_/ \_____/ \_/ \__/
         |      |     |     |   |
       Scheme  Sub  Domain Top Port
       |      Domain Name Level   ||
       |      |Name       Domain  ||
       |      |\_____________/    ||
       |      |       |           ||
       |      |      Host         ||
       |       \__________________/|
       |               |           |
       |           AUTHORITY       |
        \_________________________/
                     |
                  Domain

  Using a website Domain's Authority to name Route configuration files
  allows Modules to define unique Routes for each website.

### Routes

  A Route defines the relationship between a collection of Names that
  map to the Names of the Requests that a Route's output should be
  served in response to, a collection of Named Positions that map to
  Named Positions provided by Roady's UI which are used to structure
  the collective output of all of the Route's that respond to the same
  Request, and a Relative Path to a `php` file, `html` file, `css`
  file, or `javascript` file.

  For example, the following json defines a single Route:

      ```
      {
          "module-name": "module-name",
          "responds-to": [
              "name-of-a-request-this-route-responds-to"
          ],
          "named-positions": [
              {
                  "position-name": "section-a",
                  "position": 1.7
              }
          ],
          "relative-path": "path\/to\/output-file.html"
      }

      ```

### Roady's User Interface (UI)

- Roady's UI uses a Router and the Routes defined by installed Modules
  to determine the `output` that should be served in Response to a
  Request.

- Roady's UI defines an internal template with the following Named
  Positions which can be targeted by the Named Positions defined by
  a Module's Routes to determine where each Module's output should
  be located relative to the output of other Modules.

        ```
        roady-page-title-placeholder

        roady-stylesheet-link-tags

        roady-head-javascript-tags

        section-a

        section-b

        section-c

        section-d

        section-e

        section-f

        section-g

        roady-footer-javascript-tags

        ```

  The Named Positions `section-a` through `section-g` can be targeted
  by the `css` styles defined by a Module.

  For example:

      .section-a { background: blue; color: orange; }

      .section-b, .section-c { background: darkblue; color: white; }

      .section-d, .section-e .section-f { background: black; color: lightgrey; }

      .section-g { background: black; color: orange; }

  The Named Position `roady-page-title-placeholder` is reserved and
  cannot be used by Modules.

  The Named Posisiton `roady-stylesheet-link-tags` can be used by
  Routes that define a Relative Path to a `css` stylesheet.

  Routes to stylesheets that are assigned the
  `roady-stylesheet-link-tags` Named Position will
  have `<link>` tags autmatically generated for
  them at the `roady-stylesheet-link-tags` position
  in Roady's UI's `output`.

  For example if a Route defined by a module named `Foo` for the
  Authority `localhost:8080` was assigned:

      the Relative Path: `css/homepage.js`

      the Named Position: `roady-stylesheet-link-tags`

  Then the following `<link>` tag would be generated for the `Foo`
  module's `homepage.css` stylesheet in Roady's UI's output at the
  `roady-stylesheet-link-tags` position when the appropriate Request
  was made.

      <link rel="stylesheet" href="http://localhost:8080/Foo/css/homepage.css">

  The Named Posisiton `roady-head-javascript-tags` and
  `roady-footer-javascript-tags` can be used by Routes that define
  a Relative Path to a `javascript` file.

  Routes to `javascript` files that are assigned the
  `roady-head-javascript-tags` or `roady-footer-javascript-tags`
  Named Position will have `<script>` tags automatically generated
  for them at the `roady-head-javascript-tags` position in Roady's
  UI's output.

  For example if a Route defined by a module named Foo for the
  Authority `localhost:8080` was assigned:

      the Relative Path `js/homepage.js`

      the Named Position `roady-head-javascript-tags`

  Then the following `<script>` tag would be generated for the `Foo`
  module's `homepage.js` javascript file in Roady's UI's output at the
  `roady-head-javascript-tags` position when the appropriate Request
  was made.


### Anatomy of a Module

Possible directory structure of a Roady Module, starting with
Module's root directory:

Module's Root Directory:

APPROPRIATE.SITE.AUTHORITY.json
                 A json file named after the appropriate website's
                 Authority which defines the Module's hard-coded
                 Routes, for example, the following defines a two
                 Routes:

                 ```
                 [
                     {
                         "module-name": "module-name",
                         "responds-to": [
                             "name-of-a-request-this-route-responds-to",
                             "name-of-another-request-this-route-responds-to"
                         ],
                         "named-positions": [
                             {
                                 "position-name": "section-a",
                                 "position": 0.0
                             },
                             {
                                 "position-name": "section-d",
                                 "position": -72.26
                             },
                             {
                                 "position-name": "section-f",
                                 "position": 0.0
                             }
                         ],
                         "relative-path": "path\/to\/output-file.html"
                     },
                     {
                         "module-name": "module-name",
                         "responds-to": [
                             "name-of-a-request-this-route-responds-to",
                             "name-of-another-request-this-route-responds-to"
                         ],
                         "named-positions": [
                             {
                                 "position-name": "section-g",
                                 "position": 0.002
                             },
                             {
                                 "position-name": "section-a",
                                 "position": 2.6
                             },
                             {
                                 "position-name": "section-c",
                                 "position": 0.001
                             }
                         ],
                         "relative-path": "path\/to\/output-file.php"
                     }
                 ]

                 ```

css              The css directory is not required, but if it exists
                 a Route will be dynamically defined for each file it
                 contains. Any additional Routes will have to be
                 configured manually in the modules
                 APPROPRIATE.SITE.AUTHORITY.json files.

js               The js directory is not required, but if it exists
                 a Route will be dynamically defined for each file it
                 contains. Any additional Routes will have to be
                 configured manually in the modules
                 APPROPRIATE.SITE.AUTHORITY.json files.

output           The output directory is not required, but if it
                 exists a Route will be dynamically defined for each
                 file it contains. Any additional Routes will have to
                 be configured manually in the modules
                 APPROPRIATE.SITE.AUTHORITY.json files.

./css:           The css directory is where a module's stylesheets
                 should be located.

                 Files in the css directory will have a Route defined
                 for them dynamically that will map to a request whose
                 name matches the files name excluding the css file
                 extension

                 For example, a file named:

                    homepage.css

                 would be served in response to a Request named:

                     homepage

                 Files whose name contains the string:

                    global

                 will be served in response to all Requests.

./js:            The js directory is where a module's javascript files
                 should be located.

                 Files in the js directory will have a Route defined
                 for them dynamically that will map to a request whose
                 name matches the files name excluding the js file
                 extension.

                 For example, a file named:

                    homepage.js

                 would be served in response to a Request named:

                     homepage

                 Files whose name contains the string:

                    global

                 will be served in response to all Requests.

./output:        The output directory is where a module's output files
                 should be located.

                 Files in the output directory will have a Route
                 defined for them dynamically that will map to a
                 request whose name matches the files name excluding
                 the php file extension.

                 For example, a file named:

                    homepage.php

                 would be served in response to a Request named:

                     homepage

                 Files whose name contains the string:

                    global

                 will be served in response to all Requests.

                 Modules may also contain other files and directories
                 that may be needed for the module to function.

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

The following is a list of namespaces for the interfaces that still
need to be defined.

The namespace also indicates the library that the interface will be
defined by.

```
### RoadyRoutingUtilities
use \Darling\RoadyRoutingUtilities\interfaces\requests\Request;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\RouteInfo;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\routing\Router;

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
use \Darling\RoadyLayoutUtilities\classes\paths\;


interface RoadyFileSystemPaths
{
    public static function pathToRoadysRootDirectory(): PathToExistingDirectory;
    public static function pathToRoadysModulesDirectory(): PathToDirectoryOfRoadyModules;

}

```

# Draft/Design Notes

Pseudo code for how Roady's index.php might be implemented:

```
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

```

### Pseudo Router Definition

```
<?php

namespace \Darling\RoadyRoutingUtilities\interfaces\routing;

use \Darling\RoadyModuleUtilities\interfaces\directory\listings\ListingOfDirectoryOfRoadyModules;
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
        private ListingOfDirectoryOfRoadyModules$listingOfDirectoryOfRoadyModules,
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
                $this->request()->url()->domain()->authority() . '.json'
                ===
                $this->determineModuleRouteJsonFileName($pathToRoadyModuleDirectory)
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
use \Darling\RoadyLayoutUtilities\interfaces\paths\;
use \Darling\RoadyLayoutUtilities\interfaces\utilities\RoadyHTMLLayoutFileReader;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyModuleUtilities\interfaces\utilities\determinators\RoadyModuleFileSystemPathDeterminator
use \Darling\RoadyRoutes\interfaces\collections\PositionNameCollection;
use \Darling\RoadyRoutes\interfaces\paths\RelativePath;
use \Darling\RoadyRoutes\interfaces\routes\Route;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\RouteInfo;
use \Darling\RoadyRoutingUtilities\interfaces\utilities\routing\Router;
/**
 * The following is a rough draft/approximation of the actual
 * implementation of this file.
 *
 * The code in this file is likely to change.
 */

class RoadyUI
{

    private const ROADY_UI_TEMPLATE_STRING = <<<'EOT'

<!DOCTYPE html>

<html>

    <head>

        <title><roady-page-title-placeholder></roady-page-title-placeholder></title>

        <!-- Begin stylesheet links -->
        <roady-stylesheet-link-tags></roady-stylesheet-link-tags>
        <!-- End stylesheet links -->

        <!-- Begin head javascript tags -->
        <roady-head-javascript-tags></roady-head-javascript-tags>
        <!-- End head javascript tags -->

    </head>

    <body>

        <!-- Begin section-a -->
        <div class="section-a">
            <section-a></section-a>
        </div>
        <!-- End section-a -->

        <!-- Begin section-b -->
        <div class="section-b">
            <section-b></section-b>
        </div>
        <!-- End section-b -->

        <!-- Begin section-c -->
        <div class="section-c">
            <section-c></section-c>
        </div>
        <!-- End section-c -->

        <!-- Begin section-d -->
        <div class="section-d">
            <section-d></section-d>
        </div>
        <!-- End section-d -->

        <!-- Begin section-e -->
        <div class="section-e">
            <section-e></section-e>
        </div>
        <!-- End section-e -->

        <!-- Begin section-f -->
        <div class="section-f">
            <section-f></section-f>
        </div>
        <!-- End section-f -->

        <!-- Begin section-g -->
        <div class="section-g">
            <section-g></section-g>
        </div>
        <!-- End section-g -->

    </body>

</html>

<!-- Begin footer javascript tags -->
<roady-footer-javascript-tags></roady-footer-javascript-tags>
<!-- End footer javascript tags -->

EOT;

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

    /**
     * @var array<string, string> $previsoulyGeneratedTextOutput
     *                            Array of <script> tags for js
     *                            files that have already been
     *                            been processed indexed by
     *                            file path.
     */
    private array $previsoulyGeneratedTextOutput = [];

    public function __construct(
        private Router $router,
        private RouteCollectionSorter $routeCollectionSorter,
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
                $this->determineRouteOutput($route);
            }
        }

        $renderedContent = self::ROADY_UI_TEMPLATE_STRING;
        foreach(
            $this->roadyUIPositionNameCollection()->collection()
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

    public function routeCollectionSorter() RouteCollectionSorter
    {
        return $this->routeCollectionSorter;
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

    private function roadyUIPositionNameCollection(): PositionNameCollection
    {
        // return a collection of PositionNames derived from the self::ROADY_UI_TEMPLATE_STRING;
        return new PositionNameCollection(...self::ROADY_UI_TEMPLATE_STRING);
    }
}
    private function determineRouteOutput(Route $route): string
    {
        $pathToRoadyModuleDirectory = new PathToRoadyModuleDirectory(
            $route->moduleName(),
            $this->listingOfDirectoryOfRoadyModules()
                 ->pathToDirectoryOfRoadyModules(),
        );
        $targetFilePath = $this->roadyModuleFileSystemPathDeterminator()
                               ->determinePathToFileInModuleDirectory(
                                   $pathToRoadyModuleDirectory,
                                   $route->relativePath(),
                          );
        if($this->fileIsAPhpFile($targetFilePath)) {
            /** Only get the output once */
            if(!isset($this->previsoulyIncludedPHPOutput[$targetFilePath])) {
                ob_start();
                include_once($targetFilePath->__toString());
                $this->previsoulyIncludedPHPOutput[$targetFilePath] = ob_get_clean();
            }
            return $this->previsoulyIncludedPHPOutput[$targetFilePath];
        }
        if($this->fileIsACssFile($targetFilePath) {
            /** Only get the output once */
            if(!isset($this->previsoulyGeneratedCSSLinks[$targetFilePath])) {
                $this->previsoulyGeneratedCSSLinks[$targetFilePath] =
                    '<link rel="stylesheet" ' .
                    'type="text/css" ' .
                    'href="' .
                    $this->routeInfo()->determineRouteUrl(
                    $this->router()->request()->domain(),
                    $route
                    ) .
                    '" />';
            }
            return $this->previsoulyGeneratedCSSLinks[$targetFilePath];
        }
        if($this->fileIsAJsFile($targetFilePath) {
            /** Only get the output once */
            if(!isset($this->previsoulyGeneratedScriptTags[$targetFilePath])) {
                $this->previsoulyGeneratedScriptTags[$targetFilePath] = '<script type="text/javascript" ' .
                       'src="' . $this->routeInfo()->determineRouteUrl(
                           $this->router()->request()->domain(),
                           $route
                ) .
                '"></script>';
            }
            return $this->previsoulyGeneratedScriptTags[$targetFilePath];
        }
        if(!isset($this->previsoulyGeneratedTextOutput[$targetFilePath])) {
            $this->previsoulyGeneratedTextOutput[$targetFilePath] =
                strval(file_get_contents($targetFilePath->__toString()));
        }
        return $this->previsoulyGeneratedTextOutput[$targetFilePath];

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
use \Darling\RoadyRoutes\interfaces\paths\RelativePath;

interface RoadyModuleFileSystemPathDeterminator
{

    public function determinePathToFileInModuleDirectory(
        PathToRoadyModuleDirectory $pathToRoadyModuleDirectory,
        RelativePath $relativePath
    ): PathToExistingFile
    {
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

