<?php


/**
 * This is a mock of the actual implementation of Roady's index.php.
 *
 * This file will change drastically before the release of Roady 2.0.
 *
 */

use Darling\RoadyRoutingUtilities\interfaces\requests\Request;
use Darling\RoadyRoutingUtilities\classes\requests\Request as RequestInstance;
use \Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory;
use \Darling\PHPFileSystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use \Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use \Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use \Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use \Darling\RoadyModuleUtilities\classes\configuration\ModuleRoutesJsonConfigurationReader as ModuleRoutesJsonConfigurationReaderInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleCSSRouteDeterminator as ModuleCSSRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleJSRouteDeterminator as ModuleJSRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\ModuleOutputRouteDeterminator as ModuleOutputRouteDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\determinators\RoadyModuleFileSystemPathDeterminator as RoadyModuleFileSystemPathDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules as ListingOfDirectoryOfRoadyModulesInstance;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules as PathToDirectoryOfRoadyModulesInstance;
use \Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory as PathToRoadyModuleDirectoryInstance;
use \Darling\RoadyModuleUtilities\interfaces\configuration\ModuleRoutesJsonConfigurationReader;
use \Darling\RoadyModuleUtilities\interfaces\determinators\ModuleCSSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\determinators\ModuleJSRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\determinators\ModuleOutputRouteDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\determinators\RoadyModuleFileSystemPathDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\directory\listings\ListingOfDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToRoadyModuleDirectory;
use \Darling\RoadyRoutes\classes\collections\RouteCollection as RouteCollectionInstance;
use \Darling\RoadyRoutes\classes\paths\RelativePath as RelativePathInstance;
use \Darling\RoadyRoutes\classes\sorters\RouteCollectionSorter as RouteCollectionSorterInstance;
use \Darling\RoadyRoutes\interfaces\collections\RouteCollection;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

class Response
{

    public function __construct(
        private Request $request,
        private RouteCollection $routeCollection
    ) {}

    public function request(): Request
    {
        return $this->request;
    }

    public function routeCollection(): RouteCollection
    {
        return $this->routeCollection;
    }

}

class Router
{

    public function __construct(
        private ListingOfDirectoryOfRoadyModules $listingOfDirectoryOfRoadyModules,
        private ModuleCSSRouteDeterminator $moduleCSSRouteDeterminator,
        private ModuleJSRouteDeterminator $moduleJSRouteDeterminator,
        private ModuleOutputRouteDeterminator $moduleOutputRouteDeterminator,
        private RoadyModuleFileSystemPathDeterminator $roadyModuleFileSystemPathDeterminator,
        private ModuleRoutesJsonConfigurationReader $moduleRoutesJsonConfigurationReader,
    ) {}

    public function handleRequest(Request $request): Response
    {
        $respondingRoutes = [];
        foreach (
        $this->listingOfDirectoryOfRoadyModules
             ->pathToRoadyModuleDirectoryCollection()
             ->collection()
            as
            $pathToRoadyModuleDirectory
        ) {
            if(
                $this->configurationFileExistsForCurrentRequestsAuthority(
                    $pathToRoadyModuleDirectory,
                    $request
                )
            ) {
                $manuallyConfiguredRoutes =
                    $this->moduleRoutesJsonConfigurationReader
                         ->determineConfiguredRoutes(
                             $request->url()
                                     ->domain()
                                     ->authority(),
                             $pathToRoadyModuleDirectory,
                             $this->roadyModuleFileSystemPathDeterminator
                         );
                $dynamicallyDeterminedCssRoutes =
                    $this->moduleCSSRouteDeterminator
                          ->determineCSSRoutes(
                              $pathToRoadyModuleDirectory
                          );
                $dynamicallyDeterminedJsRoutes =
                    $this->moduleJSRouteDeterminator
                         ->determineJSRoutes(
                             $pathToRoadyModuleDirectory
                         );
                $dynamicallyDeterminedOutputRoutes =
                    $this->moduleOutputRouteDeterminator
                         ->determineOutputRoutes(
                             $pathToRoadyModuleDirectory
                         );
                $determinedRoutes = array_merge(
                    $manuallyConfiguredRoutes->collection(),
                    $dynamicallyDeterminedCssRoutes->collection(),
                    $dynamicallyDeterminedJsRoutes->collection(),
                    $dynamicallyDeterminedOutputRoutes->collection(),
                );
                foreach($determinedRoutes as $route) {
                    if(
                        in_array(
                            $request->name(),
                            $route->nameCollection()->collection()
                        )
                        ||
                        in_array(
                            new NameInstance(new TextInstance('global')),
                            $route->nameCollection()->collection()
                        )
                    ) {
                        $respondingRoutes[] = $route;
                    }
                }
            }
        }
        return new Response(
            $request,
            new RouteCollectionInstance(...$respondingRoutes)
        );
    }

    private function configurationFileExistsForCurrentRequestsAuthority(
        PathToRoadyModuleDirectory $pathToRoadyModuleDirectory,
        Request $request
    ): bool
    {
        return str_replace(
            ':',
            '.',
            $request->url()->domain()->authority()->__toString()
        ) . '.json'
        ===
        $this->determinePathToConfigurationFile(
            $pathToRoadyModuleDirectory,
            $request
        )->name()->__toString();
    }

    private function determinePathToConfigurationFile(
        PathToRoadyModuleDirectory $pathToRoadyModuleDirectory,
        Request $request
    ): PathToExistingFile
    {
        return $this->roadyModuleFileSystemPathDeterminator
                    ->determinePathToFileInModuleDirectory(
                        $pathToRoadyModuleDirectory,
                        new RelativePathInstance(
                            new SafeTextCollectionInstance(
                                new SafeTextInstance(
                                    new TextInstance(
                                        str_replace(
                                            ':',
                                            '.',
                                            $request->url()
                                                    ->domain()
                                                    ->authority()
                                                    ->__toString()
                                        ) . '.json'
                                    )
                                )
                            )
                        ),
                    );
    }


}

class RoadyAPI
{

    public static function pathToDirectoryOfRoadyModules(): PathToDirectoryOfRoadyModules
    {
        $roadysRootDirectory = __DIR__;
        $roadysRootDirectoryParts = explode(
            DIRECTORY_SEPARATOR,
            $roadysRootDirectory
        );
        $safeText = [];
        foreach ($roadysRootDirectoryParts as $pathPart) {
            if(!empty($pathPart)) {
                $safeText[] = new SafeTextInstance(
                    new TextInstance($pathPart)
                );
            }
        }
        $safeText[] = new SafeTextInstance(
            new TextInstance('modules')
        );
        return new PathToDirectoryOfRoadyModulesInstance(
            new PathToExistingDirectory(
                new SafeTextCollectionInstance(...$safeText),
            ),
        );
    }
}

class RoadyUI
{

    private const ROADY_UI_META_DESCRIPTION = 'roady-ui-meta-description';
    private const ROADY_UI_META_AUTHOR = 'roady-ui-meta-author';
    private const ROADY_UI_META_KEYWORDS = 'roady-ui-meta-keywords';
    private const ROADY_UI_CSS_STYLESHEET_LINK_TAGS = 'roady-ui-css-stylesheet-link-tags';
    private const ROADY_UI_FOOTER = 'roady-ui-footer';
    private const ROADY_UI_HEADER = 'roady-ui-header';
    private const ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML = 'roady-ui-js-script-tags-for-end-of-html';
    private const ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD = 'roady-ui-js-script-tags-for-html-head';
    private const ROADY_UI_MAIN_CONTENT = 'roady-ui-main-content';
    private const ROADY_UI_PAGE_TITLE_PLACEHOLDER = 'roady-ui-page-title-placeholder';
    private const ROADY_UI_PRE_HEADER = 'roady-ui-pre-header';

    /**
     * @var array<int, string> $availableNamedPositions
     */
    private array $availableNamedPositions = [
        self::ROADY_UI_META_DESCRIPTION,
        self::ROADY_UI_META_AUTHOR,
        self::ROADY_UI_META_KEYWORDS,
        self::ROADY_UI_CSS_STYLESHEET_LINK_TAGS,
        self::ROADY_UI_FOOTER,
        self::ROADY_UI_HEADER,
        self::ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML,
        self::ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD,
        self::ROADY_UI_MAIN_CONTENT,
        self::ROADY_UI_PAGE_TITLE_PLACEHOLDER,
        self::ROADY_UI_PRE_HEADER,
    ];

    /**
     * @var array<string, string> $renderedOutput
     */
    private array $renderedOutput = [];

    private const ROADY_UI_LAYOUT_STRING = <<<'EOT'
<!DOCTYPE html>

<html>

    <head>

        <title><roady-ui-page-title-placeholder></roady-ui-page-title-placeholder></title>

        <meta charset="UTF-8">

        <meta name="description" content="<roady-ui-meta-description></roady-ui-meta-description>">

        <meta name="keywords" content="<roady-ui-meta-keywords></roady-ui-meta-keywords>">

        <meta name="author" content="<roady-ui-meta-author></roady-ui-meta-author>">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <roady-ui-css-stylesheet-link-tags></roady-ui-css-stylesheet-link-tags>

        <roady-ui-js-script-tags-for-html-head></roady-ui-js-script-tags-for-html-head>

    </head>

    <body>

        <roady-ui-pre-header></roady-ui-pre-header>

        <header class="roady-ui-header">

            <roady-ui-header></roady-ui-header>

        </header>


        <main class="roady-ui-main-content">

            <roady-ui-main-content></roady-ui-main-content>

        </main>

        <footer class="roady-ui-footer">

            <roady-ui-footer></roady-ui-footer>

        </footer>


    </body>

</html>

<roady-ui-js-script-tags-for-end-of-html></roady-ui-js-script-tags-for-end-of-html>

<!-- Powered by Roady (https://github.com/sevidmusic/roady) -->

EOT;
    public function __construct(private PathToDirectoryOfRoadyModules $pathToDirectoryOfRoadyModules, private RouteCollectionSorter $routeCollectionSorter, private RoadyModuleFileSystemPathDeterminator $roadyModuleFileSystemPathDeterminator) {}

    public function render(Response $response): string
    {
        $uiLayoutString = self::ROADY_UI_LAYOUT_STRING;
        $sortedRoutes = $this->routeCollectionSorter
                             ->sortByNamedPosition(
                                 $response->routeCollection()
                             );
        $renderedOutput = [];
        foreach($sortedRoutes as $namedPosition => $routes) {
            foreach($routes as $position => $route) {
            #var_dump([$namedPosition, $route->relativePath()->__toString()]);
                $pathToRoadyModuleDirectory =
                    new PathToRoadyModuleDirectoryInstance(
                        $this->pathToDirectoryOfRoadyModules,
                        $route->moduleName()
                    );
                $pathToFile = $this->roadyModuleFileSystemPathDeterminator
                                   ->determinePathToFileInModuleDirectory(
                                       $pathToRoadyModuleDirectory,
                                       $route->relativePath()
                                   );
                $fileExtension = pathinfo(
                    $pathToFile,
                    PATHINFO_EXTENSION
                );
                $webPathToFile = $response->request()
                                          ->url()
                                          ->domain()
                                          ->__toString() .
                                          DIRECTORY_SEPARATOR .
                                          basename(
                                              $this->pathToDirectoryOfRoadyModules
                                              ->__toString()
                                          ) .
                                          DIRECTORY_SEPARATOR .
                                          $pathToRoadyModuleDirectory->name()
                                                                     ->__toString();
                $renderedOutput[$namedPosition][] = match($fileExtension) {
                    'css' =>
                    '        <!-- ' .
                        $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    '        <link rel="stylesheet" href="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '">',
                    'js' =>
                    '        <!-- ' .
                        $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    '        <script src="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '"></script>',
                    default => $this->determineOutput($pathToFile, $namedPosition, $position),
                };
            }
        }
        foreach(
            $this->availableNamedPositions as $availableNamedPosition
        ) {
            if(
                $availableNamedPosition !== self::ROADY_UI_PAGE_TITLE_PLACEHOLDER
                &&
                isset($renderedOutput[$availableNamedPosition])
            ) {
                $uiLayoutString = match(
                    $availableNamedPosition === self::ROADY_UI_CSS_STYLESHEET_LINK_TAGS
                    ||
                    $availableNamedPosition === self::ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD
                    ||
                    $availableNamedPosition === self::ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML
                ) {
                    true => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        implode(PHP_EOL, $renderedOutput[$availableNamedPosition]),
                        $uiLayoutString
                    ),
                    default => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        implode(
                            PHP_EOL,
                            $renderedOutput[$availableNamedPosition]
                        ),
                        $uiLayoutString
                    ),
                };
            }
            // Set title
            $uiLayoutString = str_replace(
                '<' . self::ROADY_UI_PAGE_TITLE_PLACEHOLDER  . '></' . self::ROADY_UI_PAGE_TITLE_PLACEHOLDER . '>',
                $response->request()->url()->domain()->__toString() . ' | ' . ucwords(str_replace('-', ' ', $response->request()->name()->__toString())),
                $uiLayoutString,
            );
            // Clean up unused/empty positions.
            $uiLayoutString = str_replace(
                '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                 '',
                $uiLayoutString,
            );
        }
        return $uiLayoutString;
    }

    private function determineOutput(PathToExistingFile $pathToFile, string $namedPosition, string $position): string
    {
        $renderedOutputKey = sha1($pathToFile->__toString());
        if(!isset($this->renderedOutput[$renderedOutputKey])) {
            $this->renderedOutput[$renderedOutputKey] =
                match($namedPosition) {
                self::ROADY_UI_META_AUTHOR,
                self::ROADY_UI_META_DESCRIPTION,
                self::ROADY_UI_META_KEYWORDS => str_replace(
                    ["\r\n", "\r", "\n", PHP_EOL],
                    '',
                    trim(
                        match(str_contains($pathToFile->name()->__toString(), '.php')) {
                            true => $this->includePHPFile($pathToFile),
                            default => strval(file_get_contents( $pathToFile->__toString())),
                        }
                    )
                ),
                default => PHP_EOL .
                    '<!-- begin ' .
                    $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    match(str_contains($pathToFile->name()->__toString(), '.php')) {
                        true => $this->includePHPFile($pathToFile),
                        default => strval(file_get_contents( $pathToFile->__toString())),
                    } .
                    PHP_EOL .
                    '<!-- end ' . $namedPosition . ' position ' . $position  . ' -->' . PHP_EOL
                };
        }
        return $this->renderedOutput[$renderedOutputKey];
    }

    private function includePHPFile(PathToExistingFile $pathToFile): string
    {
        $output = '<div class="roady-ui-error"><h2>Error</h2><p>Failed to load content for: ' . $pathToFile->__toString() . '</p></div>';
        ob_start();
        require_once($pathToFile->__toString());
        $renderedOutput = ob_get_contents();
        if(is_string($renderedOutput)) {
            $output = $renderedOutput;
        }
        ob_end_clean();
        return $output;
    }
}

$requestsUrls = [
    'https://foo.bar.baz:2343/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'https://foo.bar:43/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'https://foo:17/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'http://foo.bar.baz:2343/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'http://foo.bar:43/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'http://foo:17/some/path/bin.html?request=specific-request&q=a&b=c#frag',
    'https://foo.bar.baz:2343/some/path/bin.html?request=specific-request&q=a&b=c',
    'https://foo.bar:43/some/path/bin.html?request=specific-request&q=a&b=c',
    'https://foo:17/some/path/bin.html?request=specific-request&q=a&b=c',
    'http://foo.bar.baz:2343/some/path/bin.html?request=specific-request&q=a&b=c',
    'http://foo.bar:43/some/path/bin.html?request=specific-request&q=a&b=c',
    'http://foo:17/some/path/bin.html?request=specific-request&q=a&b=c',
    'http://foo:17/some/path/bin.html?request=specific-request&q=a&b=Kathooks%20Music',
    'https://foo.bar.baz:2343/some/path/bin.html',
    'https://foo.bar:43/some/path/bin.html',
    'https://foo:17/some/path/bin.html',
    'http://foo.bar.baz:2343/some/path/bin.html',
    'http://foo.bar:43/some/path/bin.html',
    'http://foo:17/some/path/bin.html',
    'https://foo.bar.baz:2343/',
    'https://foo.bar:43/',
    'https://foo:17/',
    'http://foo.bar.baz:2343/',
    'http://foo.bar:43/',
    'http://foo:17/',
    'https://',
    'http://',
    '',
    null,
];

$testRequestsUrl = $requestsUrls[array_rand($requestsUrls)];
$currentRequest =  new RequestInstance($testRequestsUrl);
$currentRequest = new RequestInstance();

$router = new Router(
    new ListingOfDirectoryOfRoadyModulesInstance(
        RoadyAPI::pathToDirectoryOfRoadyModules()
    ),
    new ModuleCSSRouteDeterminatorInstance(),
    new ModuleJSRouteDeterminatorInstance(),
    new ModuleOutputRouteDeterminatorInstance(),
    new RoadyModuleFileSystemPathDeterminatorInstance(),
    new ModuleRoutesJsonConfigurationReaderInstance(),
);

$response = $router->handleRequest($currentRequest);

$roadyUI = new RoadyUI(
    RoadyAPI::pathToDirectoryOfRoadyModules(),
    new RouteCollectionSorterInstance(),
    new RoadyModuleFileSystemPathDeterminatorInstance()
);

echo $roadyUI->render($response);

