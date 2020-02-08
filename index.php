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
    </style>
</head>
<body Id="animate">
<?php
$request = new Request(
    new Storable('Request', 'Web', 'Requests'),
    new Switchable()
);
$request->switchState();
echo '<p>Request url: ' . $request->getUrl() . '</p>';
echo '<p>Request Id: ' . $request->getUniqueId() . '</p>';

echo '<ul>';
foreach ($request->getGet() as $key => $value) {
    echo "<li>$key : $value</li>";
}
echo '</ul>';
echo '<ul>';
foreach ($request->getPost() as $key => $value) {
    echo "<li>$key : $value</li>";
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
echo '<p>OutputComponent Id: ' . $outputComponent->getUniqueId() . ':</p><p>Output: ' . $outputComponent->getOutput() . '</p>';
?>
<?php
$response = new Response(
    new Storable('Response', 'Web', 'Responses'),
    new Switchable()
);
$response->switchState();
$response->addRequest($request);
$response->addOutputComponentStorageInfo($outputComponent);
echo '<p>Response with Id ' . $response->getUniqueId() . ' responds to request with Id "' . $request->getUniqueId() . '"<br>: ' . ($response->respondsToRequest($request) === true ? 'True' : 'False') . '</p>';
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
echo '<p>Using Crud with Id: ' . $crud->getUniqueId() . '</p>';
?>
<?php
echo($crud->create($response) ? '<p>Saved OutputComponent with Id ' . $response->getUniqueId() . '</p>' : '<p>Failed to save OutputComponent with Id ' . $response->getUniqueId() . '</p>');
echo($crud->create($outputComponent) ? '<p>Saved OutputComponent with Id ' . $outputComponent->getUniqueId() . '</p>' : '<p>Failed to save OutputComponent with Id ' . $outputComponent->getUniqueId() . '</p>');
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
<h1>Output retrieved using Router:</h1>
<?php
foreach ($router->getResponses($response->getLocation(), $response->getContainer()) as $storedResponse) {
    /**
     * @var \DarlingCms\interfaces\component\Web\Routing\Response $storedResponse
     * @var \DarlingCms\interfaces\primary\Storable $outputComponentStorable
     */
    foreach ($storedResponse->getOutputComponentStorageInfo() as $outputComponentStorable) {
        echo '<p>Loaded storage info for ' . $storedResponse->getName() . $storedResponse->getUniqueId(). '</p>';
        echo '<p>Output: ' . $crud->read($outputComponentStorable)->getOutput();
    }
}
?>
<form method='post'>
    <input type="submit"/>
    <input type="hidden" name="hiddenValue" value="someValue"/>
</form>
</body>
</html>
