<?php

use Darling\PHPTextTypes\classes\strings\Name;
use Darling\PHPTextTypes\classes\strings\Text;
use Darling\Roady\classes\api\RoadyAPI;
use Darling\RoadyModuleUtilities\classes\determinators\ModuleOutputRouteDeterminator;
use Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory;

$pathToDirectoryOfRoadyModules = RoadyAPI::pathToDirectoryOfRoadyModules();
$moduleOutputDeterminator = new ModuleOutputRouteDeterminator();
$requestNames = [];
$pathToDirectoryOfRoadyModulesListing = array_diff(
    scandir($pathToDirectoryOfRoadyModules->__toString()),
    ['..', '.']
);
foreach ($pathToDirectoryOfRoadyModulesListing as $listing) {
    if (
        is_dir(
            $pathToDirectoryOfRoadyModules
            .DIRECTORY_SEPARATOR
            .$listing
        )
    ) {
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
    echo "<li><a href=\"?request={$requestName}\"><span class=\"darling-link-prefix-icon\">{$rightTriangleIconHtmlCode}</span> {$displayName}</a></li>";
}
?>
    </menu>
</nav>

