<?php

declare(strict_types=1);

namespace Darling\Roady\classes\api;

use Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory as PathToExistingDirectoryInstance;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use Darling\Roady\interfaces\api\RoadyAPI as RoadyAPIInterface;
use Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules as PathToDirectoryOfRoadyModulesInstance;
use Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;

class RoadyAPI implements RoadyAPIInterface
{
    public static function pathToDirectoryOfRoadyModules(): PathToDirectoryOfRoadyModules
    {
        $roadysRootDirectory = str_replace('src'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'api', '', __DIR__);
        $roadysRootDirectoryParts = explode(
            DIRECTORY_SEPARATOR,
            $roadysRootDirectory
        );
        $safeText = [];
        foreach ($roadysRootDirectoryParts as $pathPart) {
            if (!empty($pathPart)) {
                $safeText[] = new SafeTextInstance(
                    new TextInstance($pathPart)
                );
            }
        }
        $safeText[] = new SafeTextInstance(
            new TextInstance('modules')
        );

        return new PathToDirectoryOfRoadyModulesInstance(
            new PathToExistingDirectoryInstance(
                new SafeTextCollectionInstance(...$safeText),
            ),
        );
    }
}
