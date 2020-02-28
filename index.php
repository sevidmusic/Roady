<?php

require(__DIR__ . '/vendor/autoload.php');

ini_set('display_errors', true);

use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Template\UserInterface\GenericUITemplate;
use DarlingCms\interfaces\component\Web\Routing\Request as WebRequestComponent;
use DarlingCms\interfaces\component\Web\Routing\Response as WebResponseComponent;
const REQUEST_LOCATION = 'Web';
const REQUEST_CONTAINER = 'Request';
const RESPONSE_LOCATION = 'Web';
const RESPONSE_CONTAINER = 'Response';
const TEMPLATE_LOCATION = 'UserInterface';
const TEMPLATE_CONTAINER = 'Template';
const OUTPUT_COMPONENT_LOCATION = 'Output';
const OUTPUT_COMPONENT_CONTAINER = 'Mock';
function getDoctype(): string
{
    return '<!DOCTYPE html>';
}

function getStyles(): string
{
    return <<<'HTML'
    <style>
    
    html {
        font-size: 18px;
    }
    
    body {
        font-size: 1em;
    }
       .gradientBg {
           background: rgb(0,0,0);
           background: radial-gradient(circle, rgba(0,0,0,1) 0%, rgba(9,98,121,1) 55%, rgba(6,3,24,1) 100%);
       }
       
       .genericContainer{
           background: #000000;
           padding: 20px;
           border: 2px solid #cddeff;
           border-radius: 7px 1px;
           opacity: 0.67;
           margin-bottom: 20px;
       }
       .genericText {
           color: #ff9368;
       }
       
       .noticeText {
           color: #ff9368;
       }
       
       .warningText {
           color: #ff9368;
       }
       
       .errorText {
           color: #ff9368;
       }
       
       .successText {
           color: #ff9368;
       }
       
       .failureText {
           color: #ff9368;
       }
       
       .formLabelText {
           color: #cddeff;
       }
       .highlightText {
           color: #cddeff;
       }
       
       .smallLongText {
           font-size: .6em;
       }
    </style>
HTML;
}

function getScripts(): string
{
    return <<<'HTML'
    <script>
    </script>
HTML;
}

function getHead(): string
{
    return sprintf(
        "%s<head>%s<title>%s</title>%s%s%s</head>",
        PHP_EOL,
        PHP_EOL . '    ',
        'Darling Cms Redesign | Dev Request -> Router <- Response Interactions',
        PHP_EOL,
        (str_replace(' ', '', getStyles()) === '<style></style>' ? '' : getStyles() . PHP_EOL),
        (str_replace([' ', PHP_EOL], '', getScripts()) === '<script></script>' ? '' : getScripts() . PHP_EOL)
    );
}

function getWelcomeMessage(): string
{
    return '<p class="genericText">This page demonstrates the interaction of Requests, Routers, Templates, ComponentCruds, and OutputComponents</p>';
}

function getBody(): string
{
    return '
        <body class="gradientBg">
            <div class="genericContainer">' . getWelcomeMessage() . '' . getCurrentRequestInfo() . '</div>
            ' . (empty(getStoredRequestMenu(getMockCrud())) ? "" : '<div class="genericContainer">' . getStoredRequestMenu(getMockCrud()) . '</div>') . '
            <div class="genericContainer">' . getForm() . '</div>
        </body>';
}

function getHtml(): string
{
    return getDoctype() . PHP_EOL . '<html lang="en">' . PHP_EOL . getHead() . PHP_EOL . getBody() . PHP_EOL . '</html>';
}

function getMockCrud(): ComponentCrud
{
    return new \DarlingCms\classes\component\Crud\ComponentCrud(
        new Storable('MockComponentCrud', 'DataManagement', 'FilesystemCrud'),
        new Switchable(),
        new Standard(
            new Storable('MockStorageDriver', 'DataManagement', 'StorageDriver'),
            new Switchable()
        )
    );
}

function generateAndStoreRequest(ComponentCrud $crud, string $url, string $name, string $location, string $container): WebRequestComponent
{
    $request = new Request(
        new Storable($name . strval(rand(1000, 9999)), $location, $container),
        new Switchable()
    );
    $request->import(['url' => $url]);
    $crud->create($request);
    return $request;
}

function getForm(): string
{
    return '<form class="genericContainer" action="/index.php" method="post">
          <input type="text" id="requestUrl" name="requestUrl" value="http://192.168.33.10/"><br>
          <input type="text" id="requestName" name="requestName" value="Mock Request"><br><br>
          <input type="hidden" name="requestLocation" value="' . REQUEST_LOCATION . '">
          <input type="hidden" name="requestContainer" value="' . REQUEST_CONTAINER . '">
          <input type="submit" value="Submit">
        </form> ';
}

function getCurrentRequest(): Request
{
    return new Request(
        new Storable(
            'CurrentRequest',
            REQUEST_LOCATION,
            REQUEST_CONTAINER),
        new Switchable()
    );
}

function getStoredRequestMenu(ComponentCrud $crud): string
{
    $menu = '<ul>';
    $requests = $crud->readAll(REQUEST_LOCATION, REQUEST_CONTAINER);
    if (empty($requests) === true) {
        return '';
    }
    foreach ($requests as $request) {
        $menu .= '<li><a href="' . $request->getUrl() . '">' . $request->getUrl() . '</a></li>';
    }
    $menu .= '</ul>';
    return '<div class="genericText">' . $menu . '</div>';
}

function getCurrentRequestInfo(): string
{
    $request = getCurrentRequest();
    return "<p class='genericText'>Current Request: {$request->getUrl()}</p>";
}

function processFormIfSubmitted(ComponentCrud $crud): bool
{
    if (empty(getCurrentRequest()->getPost()) === false) {
        $generatedRequest = generateAndStoreRequest(
            $crud,
            getCurrentRequest()->getPost()['requestUrl'],
            getCurrentRequest()->getPost()['requestName'],
            getCurrentRequest()->getPost()['requestLocation'],
            getCurrentRequest()->getPost()['requestContainer']
        );
        generateAndStoreResponse($crud, $generatedRequest);
    }
    return true;
}

function generateAndStoreResponse(ComponentCrud $crud, WebRequestComponent $requestToAssign): WebResponseComponent
{
    $response = new Response(
        new Storable(
            'MockResponse',
            RESPONSE_LOCATION,
            RESPONSE_CONTAINER
        ),
        new Switchable()
    );
    $response->addRequestStorageInfo($requestToAssign);
    $outputComponent = getMockOutputComponent();
    $template = getMockTemplate();
    $response->addOutputComponentStorageInfo($outputComponent);
    $response->addTemplateStorageInfo($template);
    $crud->create($response);
    $crud->create($outputComponent);
    $crud->create($template);
    return $response;
}

function getMockTemplate(): GenericUITemplate
{
    $template = new \DarlingCms\classes\component\Template\UserInterface\GenericUITemplate(
        new Storable('MockTemplate', TEMPLATE_LOCATION, TEMPLATE_CONTAINER),
        new Switchable(),
        new Positionable()
    );
    $template->addType(getMockOutputComponent());
    return $template;
}

function getMockOutputComponent(): \DarlingCms\interfaces\component\OutputComponent
{
    $outputComponent = new OutputComponent(
        new Storable(
            'MockOutputComponent',
            OUTPUT_COMPONENT_LOCATION,
            OUTPUT_COMPONENT_CONTAINER
        ),
        new Switchable(),
        new Positionable()
    );
    $outputComponent->import(
        [
            'output' =>
                sprintf(
                    "Some mock output from output component with id: <span class=\"highlightText smallLongText\">%s</span>",
                    $outputComponent->getUniqueId()
                )
        ]
    );
    return $outputComponent;
}

processFormIfSubmitted(getMockCrud());
echo getHtml();
foreach (getMockCrud()->readAll(OUTPUT_COMPONENT_LOCATION, OUTPUT_COMPONENT_CONTAINER) as $oc) {
    echo '<p class="successText">' . $oc->getOutput() . '</p>';
}