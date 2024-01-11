This file contains notes and psuedo code for Roady 2.0:

### Roady's API

Though Roady will primarily rely on modules and other darling
libraries for most of it's functionality, Roady will define a
simple API in the form of classes that define static methods.

### Possible api class: \Darling\Roady\api\RoadyFileSystemPaths;

```php
<?php

namespace \Darling\Roady\api;

use \Darling\PHPFilesystemPaths\interfaces\paths\PathToExistingDirectory;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyLayouts;


interface RoadyFileSystemPaths
{
    public static function pathToRoadysRootDirectory(): PathToExistingDirectory;
    public static function pathToRoadysModulesDirectory(): PathToDirectoryOfRoadyModules;
    public static function pathToRoadysLayoutsDirectory(): PathToDirectoryOfRoadyLayouts;

}

```

# Draft/Design Notes

Pseudo code for how Roady's index.php might be implemented:

```php
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

```php
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
                $this->routeConfigurationFileExistsForRequestedAuthority(
                    $this->request()->url()->domain()->authority()
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

```php
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

    /** Default layout used if there isn't a layout for the current Request */
    private const ROADY_UI_LAYOUT_STRING = <<<'EOT'

<!DOCTYPE html>

<html>

    <head>

        <title><roady-page-title-placeholder></roady-page-title-placeholder></title>

        <roady-stylesheet-link-tags></roady-stylesheet-link-tags>

        <roady-head-javascript-tags></roady-head-javascript-tags>

    </head>

    <body>

        <section-a></section-a>

        <section-b></section-b>

        <section-c></section-c>

        <section-d></section-d>

        <section-e></section-e>

        <section-f></section-f>

        <section-g></section-g>

    </body>

</html>

<roady-footer-javascript-tags></roady-footer-javascript-tags>

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

        $renderedContent = self::ROADY_UI_LAYOUT_STRING;
        foreach(
            $this->roadyUIPositionNameCollection()->collection()
            as
            $positionName
        ) {
            $renderedContent = str_replace(
                '<' . $positionName->__toString() . '></' . $positionName->__toString() . '>',
                '<!-- Begin ' . $positionName->__toString() . ' -->' .
                '<div class="' . $positionName->__toString() . '">' .
                implode(PHP_EOL, ($routeOutputStrings[$positionName] ?? [])) .
                '</div>' .
                '<!-- End ' . $positionName->__toString() . ' -->',
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
        // return a collection of PositionNames derived from the self::ROADY_UI_LAYOUT_STRING;
        return new PositionNameCollection(...self::ROADY_UI_LAYOUT_STRING);
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

```php
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

```php
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
