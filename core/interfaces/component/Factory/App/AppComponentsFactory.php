<?php

namespace roady\interfaces\component\Factory\App;

use roady\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use roady\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use roady\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Web\App as AppInterface;

interface AppComponentsFactory extends StoredComponentFactoryInterface, OutputComponentFactoryInterface, RequestFactoryInterface, ResponseFactoryInterface
{

    public const SHOW_LOG = 2;
    public const SAVE_LOG = 4;

    /**
     * @return array<mixed>
     */
    public static function buildConstructorArgs(RequestInterface $domain, AppInterface|null $app = null): array;

    public static function buildDomain(string $url): RequestInterface;

    public function buildLog(int $flags = 0): string;

}
