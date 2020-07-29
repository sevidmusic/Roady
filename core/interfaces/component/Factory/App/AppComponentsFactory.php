<?php

namespace DarlingCms\interfaces\component\Factory\App;

use DarlingCms\interfaces\component\Factory\OutputComponentFactory;
use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\interfaces\component\Factory\RequestFactory;
use DarlingCms\interfaces\component\Factory\ResponseFactory;
use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Web\Routing\Request;

interface AppComponentsFactory extends StoredComponentFactoryInterface, OutputComponentFactory, StandardUITemplateFactory, RequestFactory, ResponseFactory
{

    public static function buildConstructorArgs(Request $domain): array;

    public static function buildDomain(string $url): Request;

    public function buildLog($flags = 0): string;

}
