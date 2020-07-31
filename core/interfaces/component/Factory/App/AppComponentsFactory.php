<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory\App;

use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

interface AppComponentsFactory extends StoredComponentFactoryInterface, OutputComponentFactory, StandardUITemplateFactory, RequestFactory, ResponseFactory
{

    public const SHOW_LOG = 2;
    public const SAVE_LOG = 4;

    public static function buildConstructorArgs(Request $domain): array;

    public static function buildDomain(string $url): Request;

    public function buildLog($flags = 0): string;

}
