<?php

use Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use Darling\PHPTextTypes\interfaces\strings\Name;
use Darling\PHPWebPaths\classes\paths\Domain as DomainInstance;
# Fragment is ignored for now because it is not available in $_SERVER, until a workaround is found the Fragment of the current Request's url will be ignored
# use Darling\PHPWebPaths\classes\paths\parts\url\Fragment as FragmentInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Path as PathInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Query as QueryInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\SubDomainName as SubDomainNameInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\TopLevelDomainName as TopLevelDomainNameInstance;
use Darling\PHPWebPaths\interfaces\paths\Url;
use Darling\PHPWebPaths\classes\paths\Url as UrlInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Authority as AuthorityInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\DomainName as DomainNameInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Host as HostInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Port as PortInstance;
use Darling\PHPWebPaths\enumerations\paths\parts\url\Scheme;
use Darling\RoadyRoutes\classes\collections\RouteCollection as RouteCollectionInstance;
use Darling\RoadyRoutes\interfaces\collections\RouteCollection;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

class CurrentRequest
{
    public function name(): Name
    {
        return new NameInstance(new TextInstance('homepage'));
    }

    private function defaultUrl(): Url
    {
        return new UrlInstance(
            domain: new DomainInstance(
                Scheme::HTTP,
                new AuthorityInstance(
                    new HostInstance(
                        domainName: new DomainNameInstance(
                            new NameInstance(
                                new TextInstance('localhost')
                            )
                        ),
                    ),
                ),
            ),
        );
    }

    public function url(): Url
    {
        $scheme = (
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
            ? Scheme::HTTPS
            : Scheme::HTTP
        );
        $host = ($_SERVER['HTTP_HOST'] ?? 'localhost');
        $uri = ($_SERVER['REQUEST_URI'] ?? '');
        #$currentRequestsUrl = $scheme->value . '://' . $host . $uri;
        $requestsUrls = [
            $scheme->value . '://' . $host . $uri,
            'https://foo.bar.baz:2343/some/path/bin.html?q=a&b=c#frag',
#            'https://foo.bar:43/some/path/bin.html?q=a&b=c#frag',
#            'https://foo:17/some/path/bin.html?q=a&b=c#frag',
#            'http://foo.bar.baz:2343/some/path/bin.html?q=a&b=c#frag',
#            'http://foo.bar:43/some/path/bin.html?q=a&b=c#frag',
#            'http://foo:17/some/path/bin.html?q=a&b=c#frag',
#            'https://foo.bar.baz:2343/some/path/bin.html?q=a&b=c',
#            'https://foo.bar:43/some/path/bin.html?q=a&b=c',
#            'https://foo:17/some/path/bin.html?q=a&b=c',
#            'http://foo.bar.baz:2343/some/path/bin.html?q=a&b=c',
#            'http://foo.bar:43/some/path/bin.html?q=a&b=c',
#            'http://foo:17/some/path/bin.html?q=a&b=c',
#            'https://foo.bar.baz:2343/some/path/bin.html',
#            'https://foo.bar:43/some/path/bin.html',
#            'https://foo:17/some/path/bin.html',
#            'http://foo.bar.baz:2343/some/path/bin.html',
#            'http://foo.bar:43/some/path/bin.html',
#            'http://foo:17/some/path/bin.html',
#            'https://foo.bar.baz:2343/',
#            'https://foo.bar:43/',
#            'https://foo:17/',
#            'http://foo.bar.baz:2343/',
#            'http://foo.bar:43/',
#            'http://foo:17/',
#            'https://',
#            'http://',
#            '',
        ];
        $currentRequestsUrl = $requestsUrls[array_rand($requestsUrls)];
        $currentRequestsUrlParts = parse_url($currentRequestsUrl);
        if(is_array($currentRequestsUrlParts)) {
            var_dump($currentRequestsUrlParts);
        }
        /**
         * If current Request's url cannot be determined default to:
         *
         * http://localhost
         *
         */
        return $this->defaultUrl();
    }
}

$currentRequest = new CurrentRequest();

$currentRequestsUrl = $currentRequest->url();

