<?php

use Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use Darling\PHPTextTypes\interfaces\strings\Name;
use Darling\PHPWebPaths\classes\paths\Domain as DomainInstance;
use Darling\PHPWebPaths\classes\paths\parts\url\Fragment as FragmentInstance;
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

class Request
{
    public function respondsTo(): Name
    {
        return new NameInstance(new TextInstance('homepage'));
    }

    public function url(): Url
    {
        return new UrlInstance(
            domain: new DomainInstance(
                (!empty($_SERVER['HTTPS']) ? Scheme::HTTPS : Scheme::HTTP),
                new AuthorityInstance(
                    new HostInstance(
                        topLevelDomainName: new TopLevelDomainNameInstance(
                            new NameInstance(
                                new TextInstance('topLevelDomainName')
                            )
                        ),
                        domainName: new DomainNameInstance(
                            new NameInstance(
                                new TextInstance(
                                    (
                                        isset($_SERVER['SERVER_NAME'])
                                        ? new PortInstance($_SERVER['SERVER_NAME'])
                                        : 'localhost'
                                    )
                                )
                            )
                        ),
                        subDomainName: new SubDomainNameInstance(
                            new NameInstance(
                                new TextInstance('subDomainName')
                            )
                        ),
                    ),
                    (
                        isset($_SERVER['SERVER_PORT'])
                        ? new PortInstance($_SERVER['SERVER_PORT'])
                        : null
                    ),
                ),
            ),
            path: new PathInstance(
                new SafeTextCollectionInstance(),
            ),
            query: new QueryInstance(new TextInstance('query')),
            fragment: new FragmentInstance(new TextInstance('fragment')),
        );
    }
}

class Response
{
    public function routes(): RouteCollection
    {
        return new RouteCollectionInstance();
    }
}

class Router
{
    public function response(): Response
    {
        return new Response();
    }
}

$request = new Request();

var_dump($_SERVER, $request->url()->__toString());

# Define mock modules

# Hello World Module (Just an output file and an empty Routes config)

# Hello Universe module (output file, and non-empty Routes config)

# Hello Universe module (output files, css files, javascript files, and 1 empty config and one non-empty config)

# In index.php, instantiate the following:

# ListingOfDirectoryOfRoadyModules

# The Determinators

# Route Config Reader

# Implement mocks of the following:

# Router

# Response

# Request

# RoadyUI

