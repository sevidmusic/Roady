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

function removeDevVarsFromRequestPostData(Request $request): bool
{
    if (isset($_POST['EXCLUDE_POST']) === true && $_POST['EXCLUDE_POST'] === 'Exclude') {
        $request->import(['post' => []]);
        return empty($request->export()['post']);
    }
    $modifiedRequestPostData = $request->export()['post'];
    unset($modifiedRequestPostData['CRUD_STATE']);
    $request->import(['post' => $modifiedRequestPostData]);
    return (isset($request->export()['post']['CRUD_STATE']) === false ? true : false);
}

function getMockRequest(): Request
{
    $request = new Request(
        new Storable('Request', 'Web', 'Requests'),
        new Switchable()
    );
    $request->switchState();
    return $request;
}

function showRequestInfo(Request $request): void
{
    echo '<p class="blueDark1">Request url: <span class="blueLight1">' . $request->getUrl() . '</span></p>';
    echo '<p class="blueDark1">$_GET vars:</p>';
    echo '<ul>';
    foreach ($request->getGet() as $key => $value) {
        echo "<li class='blueDark1'><span class='tanDark1'>$key</span> : $value</li>";
    }
    echo '</ul>';
    echo '<p class="blueDark1">$_POST vars:' . (isset($_POST['EXCLUDE_POST']) && $_POST['EXCLUDE_POST'] === 'Exclude' ? '<br><span style="color: indianred; font-size: .7em;">Notice: Post Vars are set to be excluded.</span>' : '') . '</p>';
    echo '<ul>';
    foreach ($request->getPost() as $key => $value) {
        if ($key === 'CRUD_STATE' || $key === 'EXCLUDE_POST') {
            continue;
        }
        echo "<li class='blueDark1'><span class='tanDark1'>$key</span> : $value</li>";
    }
    echo '</ul>';
}

function getMockOutputComponent(): OutputComponent
{
    $outputComponent = new OutputComponent(
        new Storable('OutputComponent', 'Output', 'PlainText'),
        new Switchable(),
        new Positionable()
    );
    $outputComponent->switchState();
    $outputComponent->import(['output' => 'Hello World!' . strval(rand(100, 999))]);
    return $outputComponent;
}

function showOutputComponentInfo(OutputComponent $outputComponent): void
{
    echo '<p class="tanDark1">OutputComponent Id: <span class="tanLight1">' . substr($outputComponent->getUniqueId(), 0, 8) . '...</span></p>';
    echo '<p class="tanDark1">Output: <span class="tanLight1">' . $outputComponent->getOutput() . '</span></p>';
}

function getMockResponse(Request $request, OutputComponent $outputComponent): Response
{
    $response = new Response(
        new Storable('Response', 'Web', 'Responses'),
        new Switchable()
    );
    $response->switchState();
    removeDevVarsFromRequestPostData($request);
    $response->addRequest($request);
    $response->addOutputComponentStorageInfo($outputComponent);
    return $response;
}

function showResponseInfo(Response $response, Request $request): void
{
    echo(
    $response->respondsToRequest($request) === true
        ?
        '<p class="blueDark1">Response with Id <span class="blueLight1">' .
        substr($response->getUniqueId(), 0, 8) .
        '...</span> responds to request with Id <span class="blueLight1"> ' .
        substr($request->getUniqueId(), 0, 9) .
        '...</span></p>'
        :
        '<p class="redDark1">Using Response with Id <span class="redLight1">' .
        $response->getUniqueId() .
        '</span> does NOT respond to request with Id <span class="redLight1"> ' .
        $request->getUniqueId() .
        '</span></p>'
    );
}

function getMockCrud(): ComponentCrud
{
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
    return $crud;
}

function showCrudInfo(ComponentCrud $crud): void
{
    if ($crud->getState() === false) {
        echo "<h3 style='color: red'>Warning: The CRUD is turned off, it will not be possible to save any data!</h3>";
    }
}

function createIfCrudIsOn(Response $response, ComponentCrud $crud, OutputComponent $outputComponent): void
{
    echo($crud->create($response) === true ? "<p>Saved Response</p>" : "<p style='color: red;'>Failed to save Response.</p>");
    echo($crud->create($outputComponent) === true ? "<p>Saved Response</p>" : "<p style='color: red;'>Failed to save Output Component.</p>");
}

function getMockRouter(Request $request, ComponentCrud $crud): Router
{
    $router = new Router(
        new Storable('Router', 'Web', 'Routers'),
        new Switchable(),
        $request,
        $crud
    );
    $router->switchState();
    return $router;
}

function showRouterInfo(Router $router, Response $response, ComponentCrud $crud): void
{
    echo(empty($router->getResponses($response->getLocation(), $response->getContainer())) === false ? "<h1 class=\"blueLight1\">Output retrieved using Router:</h1>" : "");
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
    <label>
        <br><span>Please select if post values should be excluded from the Request before it is assigned to the Response:</span><br>
        <select name="EXCLUDE_POST">
            <option>Exclude</option>
            <option>Include</option>
        </select>
    </label>
    <input type="submit"/>
</form>
<?php
$request = getMockRequest();
showRequestInfo($request);

$outputComponent = getMockOutputComponent();
showOutputComponentInfo($outputComponent);

$response = getMockResponse($request, $outputComponent);
showResponseInfo($response, $request);

$crud = getMockCrud();
showCrudInfo($crud);
createIfCrudIsOn($response, $crud, $outputComponent);

$router = getMockRouter($request, $crud);
showRouterInfo($router, $response, $crud);
?>
</body>
</html>
