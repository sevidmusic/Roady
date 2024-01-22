<?php





# Fragment is ignored for now because it is not available in $_SERVER, until a workaround is found the Fragment of the current Request's url will be ignored
# use Darling\PHPWebPaths\classes\paths\parts\url\Fragment as FragmentInstance;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use Darling\PHPTextTypes\interfaces\strings\Name;
use Darling\PHPWebPaths\classes\paths\Domain as DomainInstance;
use Darling\PHPWebPaths\classes\paths\Url as UrlInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Authority as AuthorityInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\DomainName as DomainNameInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Host as HostInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Path as PathInstance;
use Darling\PHPWebPaths\interfaces\paths\parts\url\Path;
use Darling\PHPWebPaths\classes\paths\parts\url\Port as PortInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Query as QueryInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\SubDomainName as SubDomainNameInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\TopLevelDomainName as TopLevelDomainNameInstance;
use Darling\PHPWebPaths\enumerations\paths\parts\url\Scheme;
use Darling\PHPWebPaths\interfaces\paths\Url;
use Darling\RoadyRoutes\classes\collections\RouteCollection as RouteCollectionInstance;
use Darling\RoadyRoutes\interfaces\collections\RouteCollection;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

class Request
{

    private const DEFAULT_HOST = 'localhost';
    private const REQUEST_PARAMETER_NAME = 'request';
    private const HTTPS_ON_VALUE = 'on';
    private const DOMAIN_SEPARATOR = '.';

    public function __construct(private string|null $testUrl = null) {}

    public function name(): Name
    {
        if(isset($this->testUrl)) {
            $urlParts = parse_url($this->testUrl);
            if(isset($urlParts['query'])) {
                $query = [];
                parse_str($urlParts['query'], $query);
                if(isset($query[self::REQUEST_PARAMETER_NAME]) && is_string($query[self::REQUEST_PARAMETER_NAME])) {
                    return new NameInstance(new TextInstance($query[self::REQUEST_PARAMETER_NAME]));
                }
            }
        }
        if(isset($_POST[self::REQUEST_PARAMETER_NAME]) && is_string($_POST[self::REQUEST_PARAMETER_NAME])) {
            return new NameInstance(new TextInstance($_POST[self::REQUEST_PARAMETER_NAME]));
        }
        if(isset($_GET[self::REQUEST_PARAMETER_NAME]) && is_string($_GET[self::REQUEST_PARAMETER_NAME])) {
            return new NameInstance(new TextInstance($_GET[self::REQUEST_PARAMETER_NAME]));
        }
        return new NameInstance(new TextInstance('homepage'));
    }


    private function newUrl(
        string $domainName,
        string $subDomainName = null,
        string $topLevelDomainName = null,
        string $path = null,
        string $query = null,
    ): Url
    {
        return new UrlInstance(
            domain: new DomainInstance(
                Scheme::HTTP,
                new AuthorityInstance(
                    new HostInstance(
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
                                    new TextInstance($topLevelDomainName)
                                )
                            )
                            : null
                        ),
                    ),
                ),
            ),
            path: (
                isset($path)
                ? new PathInstance($this->deriveSafeTextCollectionFromPathString($path))
                : null
            ),
            query: (
                isset($query)
                ? new QueryInstance(new TextInstance($query))
                : null
            ),
            # fragment
        );
    }


    private function deriveSafeTextCollectionFromPathString(string $path): SafeTextCollection
    {
        $pathParts = explode(DIRECTORY_SEPARATOR, $path);
        $safeText = [];
        foreach ($pathParts as $pathPart) {
            if (!empty($pathPart)) {
                # code...
                $safeText[] = new SafeTextInstance(new TextInstance($pathPart));
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
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === self::HTTPS_ON_VALUE
            ? Scheme::HTTPS
            : Scheme::HTTP
        );
        $host = ($_SERVER['HTTP_HOST'] ?? self::DEFAULT_HOST);
        $uri = ($_SERVER['REQUEST_URI'] ?? '');
        return $scheme->value . '://' . $host . $uri;
    }

    public function url(): Url
    {
        $currentRequestsUrlParts = parse_url(
            (
                isset($this->testUrl)
                ? $this->testUrl
                : $this->determineCurrentRequestUrlString()
            )
        );
        if(is_array($currentRequestsUrlParts)) {
            $domains = explode(
                self::DOMAIN_SEPARATOR,
                $currentRequestsUrlParts['host'] ?? self::DEFAULT_HOST
            );
            var_dump($currentRequestsUrlParts);
            return match(count($domains)) {
                1 => $this->newUrl(domainName: $domains[0], path: ($currentRequestsUrlParts['path'] ?? null), query: ($currentRequestsUrlParts['query'] ?? null)),
                2 => $this->newUrl(subDomainName: $domains[0], domainName: $domains[1], path: ($currentRequestsUrlParts['path'] ?? null), query: ($currentRequestsUrlParts['query'] ?? null)),
                3 => $this->newUrl(subDomainName: $domains[0], domainName: $domains[1], topLevelDomainName: $domains[2], path: ($currentRequestsUrlParts['path'] ?? null), query: ($currentRequestsUrlParts['query'] ?? null)),
                default => $this->defaultUrl(), #todo Should be same as case 1 but with DEFAULT_HOST
            };
        }
        return $this->defaultUrl();
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
];

$testRequestsUrl = $requestsUrls[array_rand($requestsUrls)];
$currentRequest = new Request((rand(0, 1) ? $testRequestsUrl : null));

var_dump(
    [
        'test url' => $testRequestsUrl,
        'determined request name' => $currentRequest->name()->__toString(),
        'determined request url' => $currentRequest->url()->__toString(),
    ]
);


?>
<form action="index.php" method="get">
    <input type="hidden" id="request" name="request" value="get-request"><br><br>
    <input type="submit" value="Submit">
</form>

<form action="index.php" method="post">
    <input type="hidden" id="request" name="request" value="post-request"><br><br>
    <input type="submit" value="Submit">
</form>

