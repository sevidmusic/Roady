<?php
/** Require Composer's auto-loader. **/

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

require(__DIR__ . '/vendor/autoload.php');

function getCrudStateFromPost(): bool
{
    if (isset($_POST['CRUD_STATE']) === true && $_POST['CRUD_STATE'] === 'On') {
        return true;
    }
    return false;
}

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
<!-- Request -->
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
echo '<p class="blueDark1">$_POST vars ' . (getCrudStateFromPost() === true ? "(Note: The CRUD_STATE post variable will be excluded from the stored request. This is intentional)" : "") . ':</p>';
echo '<ul>';
foreach ($request->getPost() as $key => $value) {
    echo "<li class='blueDark1'><span class='tanDark1'>$key</span> : $value</li>";
}
echo '</ul>';

?>
<!-- Output Component -->
<?php
$outputComponent = new OutputComponent(
    new Storable('OutputComponent', 'Output', 'PlainText'),
    new Switchable(),
    new Positionable()
);
$outputComponent->switchState();
$outputComponent->import(['output' => 'Hello World!' . strval(rand(100, 999))]);
echo '<p class="tanDark1">OutputComponent Id: <span class="tanLight1">' . $outputComponent->getUniqueId() . ':</span></p>';
echo '<p class="tanDark1">Output: <span class="tanLight1">' . $outputComponent->getOutput() . '</span></p>';
?>
<!-- Response -->
<?php
$response = new Response(
    new Storable('Response', 'Web', 'Responses'),
    new Switchable()
);
$response->switchState();
function removeDevVarsFromRequestPostData(Request $request)
{
    $modifiedRequestPostData = $request->export()['post'];
    unset($modifiedRequestPostData['CRUD_STATE']);
    $request->import(['post' => $modifiedRequestPostData]);
}

removeDevVarsFromRequestPostData($request);
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
<!-- Component Crud -->
<?php
$crud = new ComponentCrud(
    new Storable('ComponentCrud', 'DataManagement', 'Crud'),
    new Switchable(),
    new Standard(
        new Storable('JsonStorageDriver', 'DataManagement', 'StorageDriver'),
        new Switchable()
    )
);

if (getCrudStateFromPost() === true && $crud->getState() === false) {
    $crud->switchState();
}
if ($crud->getState() === false) {
    echo "<h3 style='color: red'>Warning: The CRUD is turned off, it will not be possible to save any data!</h3>";
}
echo '<p class="tanDark1">Using Crud with Id: <span class="tanLight1">' . $crud->getUniqueId() . '</span></p>';

echo($crud->create($response) ? '<p class="tanDark1">Saved OutputComponent with Id <span class="tanLight1">' . $response->getUniqueId() . '</span></p>' : '<p class="redDark1">Failed to save OutputComponent with Id <span class="redLight1">' . $response->getUniqueId() . '</span></p>');
echo($crud->create($outputComponent) ? '<p class="tanDark1">Saved OutputComponent with Id <span class="tanLight1">' . $outputComponent->getUniqueId() . '</span></p>' : '<p class="redDark1">Failed to save OutputComponent with Id <span class="redLight1">' . $outputComponent->getUniqueId() . '</span></p>');

?>
<!-- Router -->
<?php
$router = new Router(
    new Storable('Router', 'Web', 'Routers'),
    new Switchable(),
    $request,
    $crud
);
$router->switchState();
echo "<h1 class=\"blueLight1\">Output retrieved using Router:</h1>";
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
    <label>
        <br><span>Please select a post value to send with the next request:</span><br>
        <select name="USER_SUBMITTED_POST_VAR">
            <option>Foo</option>
            <option>Bar</option>
            <option>Baz</option>
        </select>
    </label>

    <label>
        <br><span>Select whether CRUD should be on or off for next request:</span>
        <br><span>(Note: If CRUD is off it will not be possible to demonstrate reading and writing data to storage!):</span><br>
        <br><span>The CRUD is currently <?php echo(getCrudStateFromPost() === true ? '<span style="color: limegreen">On</span>' : '<span style="color: red">Off</span>'); ?></span><br>
        <select name="CRUD_STATE">
            <?php
            echo(getCrudStateFromPost() === true
                ? "<option selected>On</option><option>Off</option>"
                : "<option>On</option><option selected>Off</option>");
            ?>
        </select>
    </label>
    <input type="submit"/>
    <input type="hidden" name="hiddenValue" value="someValue"/>
</form>
</body>
</html>
