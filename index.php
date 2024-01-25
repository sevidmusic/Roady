<?php


/**
 * This is a mock of the actual implementation of Roady's index.php.
 *
 * This file will change drastically before the release of Roady 2.0.
 *
 */

use \Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory;
use \Darling\PHPFileSystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use \Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use \Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use \Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use \Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPWebPaths\classes\paths\Domain as DomainInstance;
use \Darling\PHPWebPaths\classes\paths\Url as UrlInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Authority as AuthorityInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\DomainName as DomainNameInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Fragment as FragmentInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Host as HostInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Path as PathInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Port as PortInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\Query as QueryInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\SubDomainName as SubDomainNameInstance;
use \Darling\PHPWebPaths\classes\paths\parts\url\TopLevelDomainName as TopLevelDomainNameInstance;
use \Darling\PHPWebPaths\enumerations\paths\parts\url\Scheme;
use \Darling\PHPWebPaths\interfaces\paths\Url;
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

class Request
{

    private const DEFAULT_HOST = 'localhost';
    private const REQUEST_PARAMETER_NAME = 'request';
    private const HTTPS_ON_VALUE = 'on';
    private const DOMAIN_SEPARATOR = '.';
    private const QUERY_PARAMETER_NAME = 'query';
    private const FRAGMENT_PARAMETER_NAME = 'fragment';
    private const SCHEME_PARAMETER_NAME = 'scheme';

    public function __construct(
        private string|null $urlString = null
    ) {}

    public function name(): Name
    {
        if(isset($this->urlString) && !empty($this->urlString)) {
            $urlParts = parse_url($this->urlString);
            if(isset($urlParts[self::QUERY_PARAMETER_NAME])) {
                $query = [];
                parse_str(
                    $urlParts[self::QUERY_PARAMETER_NAME],
                    $query
                );
                if(
                    isset($query[self::REQUEST_PARAMETER_NAME])
                    &&
                    is_string($query[self::REQUEST_PARAMETER_NAME])
                ) {
                    return new NameInstance(
                        new TextInstance(
                            $query[self::REQUEST_PARAMETER_NAME]
                        )
                    );
                }
            }
        }
        if(
            isset($_POST[self::REQUEST_PARAMETER_NAME])
            &&
            is_string($_POST[self::REQUEST_PARAMETER_NAME])
        ) {
            return new NameInstance(
                new TextInstance($_POST[self::REQUEST_PARAMETER_NAME])
            );
        }
        if(
            isset($_GET[self::REQUEST_PARAMETER_NAME])
            &&
            is_string($_GET[self::REQUEST_PARAMETER_NAME])
        ) {
            return new NameInstance(
                new TextInstance($_GET[self::REQUEST_PARAMETER_NAME])
            );
        }
        return new NameInstance(new TextInstance('homepage'));
    }

    public function url(): Url
    {
        $currentRequestsUrlParts = parse_url(
            (
                isset($this->urlString) && !empty($this->urlString)
                ? $this->urlString
                : $this->determineCurrentRequestUrlString()
            )
        );
        if(is_array($currentRequestsUrlParts)) {
            $domains = explode(
                self::DOMAIN_SEPARATOR,
                $currentRequestsUrlParts['host'] ?? self::DEFAULT_HOST
            );
            $port = intval($currentRequestsUrlParts['port'] ?? null);
            $path = ($currentRequestsUrlParts['path'] ?? null);
            $query = (
                $currentRequestsUrlParts[self::QUERY_PARAMETER_NAME]
                ??
                null
            );
            $fragment = (
                $currentRequestsUrlParts[self::FRAGMENT_PARAMETER_NAME]
                ??
                null
            );
            $scheme = match(
                $currentRequestsUrlParts[self::SCHEME_PARAMETER_NAME]
                ??
                null
            ) {
                Scheme::HTTPS->value => Scheme::HTTPS,
                default => Scheme::HTTP,
            };

            return match(count($domains)) {
                1 => $this->newUrl(
                    domainName: $domains[0],
                    fragment: $fragment,
                    path: $path,
                    port: $port,
                    query: $query,
                    scheme: $scheme,
                ),
                2 => $this->newUrl(
                    domainName: $domains[1],
                    fragment: $fragment,
                    path: $path,
                    port: $port,
                    query: $query,
                    scheme: $scheme,
                    subDomainName: $domains[0],
                ),
                3 => $this->newUrl(
                    domainName: $domains[1],
                    fragment: $fragment,
                    path: $path,
                    port: $port,
                    query: $query,
                    scheme: $scheme,
                    subDomainName: $domains[0],
                    topLevelDomainName: $domains[2],
                ),
                default => $this->newUrl(
                    domainName: self::DEFAULT_HOST,
                    fragment: $fragment,
                    path: $path,
                    port: $port,
                    query: $query,
                    scheme: $scheme,
                ),
            };
        }
        return $this->defaultUrl();
    }

    private function newUrl(
        string $domainName,
        string $subDomainName = null,
        string $topLevelDomainName = null,
        int $port = null,
        string $path = null,
        string $query = null,
        string $fragment = null,
        Scheme $scheme = null,
    ): Url
    {
        return new UrlInstance(
            domain: new DomainInstance(
                scheme: (isset($scheme) ? $scheme : Scheme::HTTP),
                authority: new AuthorityInstance(
                    host: new HostInstance(
                        subDomainName: (
                            isset($subDomainName)
                            ? new SubDomainNameInstance(
                                new NameInstance(
                                    new TextInstance($subDomainName)
                                )
                            )
                            : null
                        ),
                        domainName: new DomainNameInstance(
                            new NameInstance(
                                new TextInstance($domainName)
                            )
                        ),
                        topLevelDomainName: (
                            isset($topLevelDomainName)
                            ? new TopLevelDomainNameInstance(
                                new NameInstance(
                                    new TextInstance(
                                        $topLevelDomainName
                                    )
                                )
                            )
                            : null
                        ),
                    ),
                    port: (
                        isset($port)
                        ? new PortInstance($port)
                        : null
                    ),
                ),
            ),
            path: (
                isset($path)
                ? new PathInstance(
                    $this->deriveSafeTextCollectionFromPathString(
                        $path
                    )
                )
                : null
            ),
            query: (
                isset($query)
                ? new QueryInstance(new TextInstance($query))
                : null
            ),
            fragment: (
                isset($fragment)
                ? new FragmentInstance(new TextInstance($fragment))
                : null
            ),
        );
    }

    private function deriveSafeTextCollectionFromPathString(
        string $path
    ): SafeTextCollection
    {
        $pathParts = explode(DIRECTORY_SEPARATOR, $path);
        $safeText = [];
        foreach ($pathParts as $pathPart) {
            if (!empty($pathPart)) {
                $safeText[] = new SafeTextInstance(
                    new TextInstance($pathPart)
                );
            }
        }
        return new SafeTextCollectionInstance(...$safeText);
    }

    private function defaultUrl(): Url
    {
        return $this->newUrl(domainName: self::DEFAULT_HOST);
    }

    private function determineCurrentRequestUrlString(): string
    {
        $scheme = (
            isset($_SERVER['HTTPS'])
            &&
            $_SERVER['HTTPS'] === self::HTTPS_ON_VALUE
            ? Scheme::HTTPS
            : Scheme::HTTP
        );
        $host = ($_SERVER['HTTP_HOST'] ?? self::DEFAULT_HOST);
        $uri = ($_SERVER['REQUEST_URI'] ?? '');
        return $scheme->value . '://' . $host . $uri;
    }

}

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

    /**
     * @var array<int, string> $availableNamedPositions
     */
    private array $availableNamedPositions = [
        'roady-ui-page-title-placeholder',
        'roady-ui-css-stylesheet-link-tags',
        'roady-ui-js-script-tags-for-html-head',
        'roady-ui-named-position-a',
        'roady-ui-named-position-b',
        'roady-ui-named-position-c',
        'roady-ui-named-position-d',
        'roady-ui-named-position-e',
        'roady-ui-named-position-f',
        'roady-ui-named-position-g',
        'roady-ui-js-script-tags-for-end-of-html',
    ];

    private const ROADY_UI_LAYOUT_STRING = <<<'EOT'
<!DOCTYPE html>

<html>

    <head>

        <title><roady-ui-page-title-placeholder></roady-ui-page-title-placeholder></title>

        <roady-ui-css-stylesheet-link-tags></roady-ui-css-stylesheet-link-tags>

        <roady-ui-js-script-tags-for-html-head></roady-ui-js-script-tags-for-html-head>

    </head>

    <body>

        <roady-ui-named-position-a></roady-ui-named-position-a>

        <roady-ui-named-position-b></roady-ui-named-position-b>

        <roady-ui-named-position-c></roady-ui-named-position-c>

        <roady-ui-named-position-d></roady-ui-named-position-d>

        <roady-ui-named-position-e></roady-ui-named-position-e>

        <roady-ui-named-position-f></roady-ui-named-position-f>

        <roady-ui-named-position-g></roady-ui-named-position-g>

    </body>

</html>

<roady-ui-js-script-tags-for-end-of-html></roady-ui-js-script-tags-for-end-of-html>

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
            foreach($routes as $route) {
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
                    'css' => '<link rel="stylesheet" href="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '">',
                    'js' => '<script src="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '"></script>',
                    default => file_get_contents(
                        $pathToFile->__toString()
                    ),
                };
            }
        }
        foreach(
            $this->availableNamedPositions as $availableNamedPosition
        ) {
            if(
                $availableNamedPosition !== 'roady-ui-page-title-placeholder'
                &&
                isset($renderedOutput[$availableNamedPosition])
            ) {
                $uiLayoutString = match(
                    $availableNamedPosition === 'roady-ui-css-stylesheet-link-tags'
                    ||
                    $availableNamedPosition === 'roady-ui-js-script-tags-for-html-head'
                    ||
                    $availableNamedPosition === 'roady-ui-js-script-tags-for-end-of-html'
                ) {
                    true => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        implode(PHP_EOL, $renderedOutput[$availableNamedPosition]),
                        $uiLayoutString
                    ),
                    default => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        PHP_EOL .
                        '<!-- begin ' . $availableNamedPosition . ' -->' .
                        PHP_EOL .
                        '<div class="' . $availableNamedPosition . '">' .
                            PHP_EOL .
                            PHP_EOL .
                            implode(
                                PHP_EOL,
                                $renderedOutput[$availableNamedPosition]
                            ) .
                            PHP_EOL .
                        '</div>' .
                        PHP_EOL .
                        '<!-- end ' . $availableNamedPosition . ' -->',
                        $uiLayoutString
                    ),
                };
            }
            // Clean up unused/empty positions.
            // css, js, and title should be removed if not used
            // named positions a-g should be replaced with an empty div whose class attribute is assigned the postions's name
            $uiLayoutString = match(
                $availableNamedPosition === 'roady-ui-css-stylesheet-link-tags'
                ||
                $availableNamedPosition === 'roady-ui-js-script-tags-for-html-head'
                ||
                $availableNamedPosition === 'roady-ui-js-script-tags-for-end-of-html'
                ||
                $availableNamedPosition === 'roady-ui-page-title-placeholder'
            ) {
                true => str_replace(
                    '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                    '',
                    $uiLayoutString
                ),
                default => str_replace(
                    '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                     PHP_EOL .
                     '<!-- begin ' . $availableNamedPosition . ' -->' .
                     PHP_EOL .
                     '<div class="' . $availableNamedPosition . '"></div>' .
                     PHP_EOL .
                    '<!-- end ' . $availableNamedPosition . ' -->',
                    $uiLayoutString
                ),

            };
            $uiLayoutString = str_replace(
                '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                 PHP_EOL .
                 '<!-- begin ' . $availableNamedPosition . ' -->' .
                 PHP_EOL .
                 '<div class="' . $availableNamedPosition . '"></div>' .
                 PHP_EOL .
                '<!-- end ' . $availableNamedPosition . ' -->',
                $uiLayoutString
            );
        }
        return $uiLayoutString;
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
$currentRequest = new Request($testRequestsUrl);
$currentRequest = new Request();

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

