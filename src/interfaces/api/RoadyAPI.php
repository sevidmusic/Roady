<?php

namespace Darling\Roady\interfaces\api;

use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;

/**
 * Description of this interface.
 *
 */
interface RoadyAPI
{
    public static function pathToDirectoryOfRoadyModules(): PathToDirectoryOfRoadyModules;
}

