<?php

use Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection;
use Darling\PHPTextTypes\classes\strings\Name;
use Darling\PHPTextTypes\classes\strings\SafeText;
use Darling\PHPTextTypes\classes\strings\Text;
use Darling\RoadyModuleUtilities\classes\determinators\ModuleOutputRouteDeterminator;
use Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules;
use Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory;

// @TODO: It is overly complex to build path, need a method to
// create SafeTextCollection from a string like 'path/to/things' or __DIR__
$pathToExistingDirectory = new PathToExistingDirectory(
    new SafeTextCollection(
        new SafeText(new Text('home')),
        new SafeText(new Text(get_current_user())),
        new SafeText(new Text('Git')),
        new SafeText(new Text('Roady')),
        new SafeText(new Text('modules')),
    )
);

$pathToDirectoryOfRoadyModules = new PathToDirectoryOfRoadyModules($pathToExistingDirectory);
$moduleOutputDeterminator = new ModuleOutputRouteDeterminator();
$requestNames = [];

foreach (scandir($pathToDirectoryOfRoadyModules->__toString()) as $listing) {
    if (!in_array($listing, ['.', '..'], true) && is_dir($pathToDirectoryOfRoadyModules.DIRECTORY_SEPARATOR.$listing)) {
        $pathToRoadyModuleDirectory = new PathToRoadyModuleDirectory(
            $pathToDirectoryOfRoadyModules,
            new Name(new Text($listing))
        );
        foreach (
            $moduleOutputDeterminator
                ->determineOutputRoutes($pathToRoadyModuleDirectory)
                ->collection() as $route
        ) {
            $requestName = $route->nameCollection()->collection()[0];
            if ('global' !== $requestName->__toString()) {
                $requestNames[] = $requestName;
            }
        }
    }
}

$uniqueRequests = array_unique($requestNames);
sort($uniqueRequests);
foreach ($uniqueRequests as $key => $requestName) {
    if ('homepage' === $requestName->__toString()) {
        unset($uniqueRequests[$key]);
        array_unshift($uniqueRequests, 'homepage');
    }
}

?>
<nav class="roady-ui-pre-header">
    <button class="darling-collapse-content-trigger">Show Menu</button>
    <menu class="darling-collapsible-content">
<?php

foreach ($uniqueRequests as $requestName) {
    $displayName = ucwords(str_replace(['_', '-'], ' ', $requestName));
    // https://www.w3schools.com/charsets/tryit.asp?deci=9205
    $rightTriangleIconHtmlCode = '&#9205;';
    echo "<li><a href=\"?request={$requestName}\">{$rightTriangleIconHtmlCode} {$displayName}</a></li>";
}
?>
    </menu>
</nav>

