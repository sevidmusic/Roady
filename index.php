<?php
/** Require Composer's auto-loader. **/

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

require(__DIR__ . '/vendor/autoload.php');
?>
<!doctype html>
<html lang="en">
<head>
    <title>Darling Cms Redesign Welcome Page</title>
    <style>
        body {
            background: #000000;
            font-family: monospace;
            color: #b8a47b;
            font-size: 24px;
        }

        .tanLight1 {
            color: #b8a47b;
        }

        .tanDark1 {
            color: #756354;
        }

        .blueLight1 {
            color: #a9f2ff
        }

        .blueDark1 {
            color: #5a8087;
        }

        .redDark1 {
            color: #873238;
        }

        .redLight1 {
            color: #ff798e;
        }

        .bg1 {
            background: #5a8087;
            padding: 1em;
        }

    </style>
</head>
<body Id="animate">
<?php
$request = new Request(
    new Storable('Request', 'Web', 'Requests'),
    new Switchable()
);
$request->switchState();
echo '<p class="blueDark1">Request url: <span class="blueLight1">' . $request->getUrl() . '</span></p>';
echo '<p class="blueDark1">Request Id: <span class="blueLight1">' . $request->getUniqueId() . '</span></p>';
echo '<p class="blueDark1">$_GET vars:</p>';
echo '<ul>';
foreach ($request->getGet() as $key => $value) {
    echo "<li class='blueDark1'><span class='tanDark1'>$key</span> : $value</li>";
}
echo '</ul>';
echo '<p class="blueDark1">$_POST vars:</p>';
echo '<ul>';
foreach ($request->getPost() as $key => $value) {
    echo "<li class='blueDark1'><span class='tanDark1'>$key</span> : $value</li>";
}
echo '</ul>';

?>
<?php
$outputComponent = new OutputComponent(
    new Storable('OutputComponent', 'Output', 'PlainText'),
    new Switchable()
);
$outputComponent->switchState();
$outputComponent->import(['output' => 'Hello World!' . strval(rand(100, 999))]);
echo '<p class="tanDark1">OutputComponent Id: <span class="tanLight1">' . $outputComponent->getUniqueId() . ':</span></p>';
echo '<p class="tanDark1">Output: <span class="tanLight1">' . $outputComponent->getOutput() . '</span></p>';
?>
<?php
$response = new Response(
    new Storable('Response', 'Web', 'Responses'),
    new Switchable()
);
$response->switchState();
$response->addRequest($request);
$response->addOutputComponentStorageInfo($outputComponent);
echo(
$response->respondsToRequest($request) === true
    ?
    '<p class="blueDark1">Response with Id <span class="blueLight1">' .
    $response->getUniqueId() .
    '</span> responds to request with Id <span class="blueLight1"> ' .
    $request->getUniqueId() .
    '</span></p>'
    :
    '<p class="redDark1">Using Response with Id <span class="redLight1">' .
    $response->getUniqueId() .
    '</span> does NOT respond to request with Id <span class="redLight1"> ' .
    $request->getUniqueId() .
    '</span></p>'
);
?>
<?php
$crud = new ComponentCrud(
    new Storable('ComponentCrud', 'DataManagement', 'Crud'),
    new Switchable(),
    new Standard(
        new Storable('JsonStorageDriver', 'DataManagement', 'StorageDriver'),
        new Switchable()
    )
);
$crud->switchState();
echo '<p class="tanDark1">Using Crud with Id: <span class="tanLight1">' . $crud->getUniqueId() . '</span></p>';
?>
<?php
echo($crud->create($response) ? '<p class="tanDark1">Saved OutputComponent with Id <span class="tanLight1">' . $response->getUniqueId() . '</span></p>' : '<p class="redDark1">Failed to save OutputComponent with Id <span class="redLight1">' . $response->getUniqueId() . '</span></p>');
echo($crud->create($outputComponent) ? '<p class="tanDark1">Saved OutputComponent with Id <span class="tanLight1">' . $outputComponent->getUniqueId() . '</span></p>' : '<p class="redDark1">Failed to save OutputComponent with Id <span class="redLight1">' . $outputComponent->getUniqueId() . '</span></p>');
?>
<?php
$router = new Router(
    new Storable('Router', 'Web', 'Routers'),
    new Switchable(),
    $request,
    $crud
);
$router->switchState();
?>
<h1 class="blueLight1">Output retrieved using Router:</h1>
<?php
foreach ($router->getResponses($response->getLocation(), $response->getContainer()) as $storedResponse) {
    /**
     * @var \DarlingCms\interfaces\component\Web\Routing\Response $storedResponse
     * @var \DarlingCms\interfaces\primary\Storable $outputComponentStorable
     */
    foreach ($storedResponse->getOutputComponentStorageInfo() as $outputComponentStorable) {
        echo '<p class="blueDark1">Loaded storage info for <span class="blueLight1">' . $storedResponse->getName() . $storedResponse->getUniqueId() . '</span></p>';
        echo '<div class="bg1"><p class="blueDark1">Output: <span class="blueLight1">' . $crud->read($outputComponentStorable)->getOutput() . '</span></div>';
    }
}
?>
<form method='post'>
    <input type="submit"/>
    <input type="hidden" name="hiddenValue" value="someValue"/>
</form>
</body>
</html>
