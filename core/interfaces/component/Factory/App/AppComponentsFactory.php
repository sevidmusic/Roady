<?php

namespace DarlingCms\interfaces\component\Factory\App;

use DarlingCms\interfaces\component\Factory\OutputComponentFactory;
use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Web\Routing\Request;

interface AppComponentsFactory extends StoredComponentFactoryInterface, OutputComponentFactory, StandardUITemplateFactory
{

    public static function buildConstructorArgs(Request $domain): array;

}
