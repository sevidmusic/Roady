<?php
require(__DIR__ . '/vendor/autoload.php');

use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\interfaces\component\Web\Routing\Request as WebRequestComponent;
use DarlingCms\interfaces\component\Web\Routing\Response as WebResponseComponent;


function getBody(): string
{
    return (
    empty(getCurrentRequest()->getGet()) === true
        ?
        (getCurrentRequest()->getUrl() === 'http://192.168.33.10/WorkingDemo.php'
            ? '
                <body class="gradientBg">
                    <div id="welcome" class="genericContainer genericContainerLimitedHeight">' . getWelcomeMessage() . '</div>
                    <div id="formContainer" class="genericContainer genericContainerLimitedHeight">' . getForm() . '</div>
                    <div id="requestMenu" class="genericContainer genericContainerLimitedHeight">' . getCurrentRequestInfo() . '</div>
                    ' . (empty(getStoredRequestMenu(getMockCrud())) ? "" : '<div class="genericContainer">' . getStoredRequestMenu(getMockCrud()) . '</div>') . '
                        ' . getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest() . '
                ' . (str_replace([' ', PHP_EOL], '', getScripts()) === '<script></script>' ? '' : getScripts() . PHP_EOL) . '
                </body>
            '
            : '
                 <body class="gradientBg">
                    <div id="welcome" class="genericContainer genericContainerLimitedHeight">' . getWelcomeMessage() . '</div>
                    <div id="requestMenu" class="genericContainer genericContainerLimitedHeight">' . getCurrentRequestInfo() . '</div>
                    ' . (empty(getStoredRequestMenu(getMockCrud())) ? "" : '<div class="genericContainer">' . getStoredRequestMenu(getMockCrud()) . '</div>') . '
                        ' . getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest() . '
                ' . (str_replace([' ', PHP_EOL], '', getScripts()) === '<script></script>' ? '' : getScripts() . PHP_EOL) . '
                </body>
             '
        )
        : getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest()
    );
}

function getWelcomeMessage(): string
{
    switch (getCurrentRequest()->getUrl() === 'http://192.168.33.10/index.php') {
        case true;
            return <<<'HTML'
    <h1 class="noticeText">Welcome</h1>
    <p class="successText">
        To see a working demo of some of the Darling Cms's core components go <a href="WorkingDemo.php">here</a>.
    </p>
HTML;
        default:
            return <<<'HTML'
    <h1 class="noticeText">Welcome</h1>
    <p class="successText">
        This is a demonstration the possible relationships/interactions of a<span class="highlightText"> Request</span>,
        <span class="highlightText"> Router</span>, <span class="highlightText"> Response</span>,
        <span class="highlightText"> Crud</span>,<span class="highlightText"> Template</span>, and
        <span class="highlightText"> OutputComponent</span>.
    </p>
    <p class="successText">
        It currently demonstrates how a stored <span class="highlightText"> Response</span> that responds
        to the current <span class="highlightText"> Request</span> can be used to determine what
        <span class="highlightText"> OutputComponent(s)</span>
        is/are used to generate output for the <span class="highlightText"> Request</span>, and which <span class="highlightText"> Template(s)</span> is/are used to
        organize that output.
    </p>
HTML;
    }
}

function formatOutput(): bool
{
    return (
    (empty(getCurrentRequest()->getGet()) === true)
    || (substr(getCurrentRequest()->getUrl(), 0, 30) === 'http://192.168.33.10/index.php')
        ? true
        : false
    );
}

function getDoctype(): string
{
    return '<!DOCTYPE html>';
}

function getHtml(): string
{
    return (formatOutput() === true
        ? getDoctype() . PHP_EOL . '<html lang="en">' . PHP_EOL . getHead() . PHP_EOL . getBody() . PHP_EOL . '</html>'
        : getBody()
    );
}

function getHead(): string
{
    return sprintf(
        "%s<head>%s<title>%s</title><meta name='viewport' content='width=device-width, initial-scale=1.0'/>%s%s%s%s</head>",
        PHP_EOL,
        PHP_EOL . '    ',
        'Darling Cms Redesign | Dev Request -> Router <- Response Interactions',
        PHP_EOL . '    ',
        '<meta charset="UTF-8">',
        PHP_EOL,
        (str_replace(' ', '', getStyles()) === '<style></style>' ? '' : getStyles() . PHP_EOL)
    //(str_replace([' ', PHP_EOL], '', getScripts()) === '<script></script>' ? '' : getScripts() . PHP_EOL)
    );
}

function getStyles(): string
{
    return <<<'HTML'
    <style>

       * {
           box-sizing: border-box;
           -webkit-box-decoration-break: clone;
           -o-box-decoration-break: clone;
           box-decoration-break: clone;
       }

       html {
           font-size: 15px;
       }

       body {
           font-size: 1em;
       }

       .gradientBg {
           background: rgb(0,0,0);
           background: radial-gradient(circle, rgba(0,0,0,1) 0%, rgba(9,98,121,1) 55%, rgba(6,3,24,1) 100%);
       }

       .genericContainerLimitedHeight {
           height: 13.5em;
           overflow: auto;
       }

       .genericContainer {
           background: #000000;
           padding: 20px;
           border: 2px solid #cddeff;
           border-radius: 7px 1px;
           opacity: 0.77;
           margin-bottom: 20px;
           line-height: 2em;
           resize: vertical;
       }
       .genericText {
           color: #ff9368;
       }

       .noticeText {
           color: #ff1858;
       }

       .warningText {
           color: #ffc16f;
       }

       .errorText {
           color: #ff0043;
       }

       .successText {
           color: #63ff99;
       }

       .failureText {
           color: #ff2c2a;
       }

       .formLabelText {
           color: #cddeff;
       }
       .highlightText {
           color: #008fff;
       }

       .miniText {
           font-size: .72em;
       }

       .input {
           width: 95%;
           background: #0e1620;
           color: #c8ffc8;
           padding: 7px;
           margin-bottom: 20px;
           border-radius: 7px 1px;
       }

       .textareaInput {
           resize: vertical;
           color: #f57fff;
       }

       .textInput {

       }

    .collapsibleButton {
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        outline: none;
        font-size: 1em;
        user-select: none;
    }

    .collapsibleButton:hover {
        border-radius: 0 0 7px 7px;
        background: #00ffb1;
        box-shadow: 0 3px 7px 0 rgba(220,247,255,0.24), 0 9px 25px 0 rgba(0,255,177,0.33);
    }

    .collapsibleButton:focus {
        background: #00ffb1;
    }
    .active {
        border-radius: 0 !important;
        border-bottom: none;
        margin-bottom: 0;
    }

    .collapsibleContent {
        display: none;
        overflow: hidden;
    }

    .outputComponentInfo {
        border-top: none;
        border-radius: 0 0 7px 7px;
    }

    .textAreaContainer {
        margin-top: 1em;
    }

    a {
        text-decoration: none;
    }

    a:visited {
        color: #decaff;
    }

    a:active, a:hover {
        background: #008fff;
        border: 1px solid #ffffff;
        border-radius: 10px;
        padding: .1em .5em;
        color: #732b3f;
    }
    table, th, td {
        border-collapse: collapse;
    }

    th, td {
        padding: 5px;
    }
    th {
        text-align: left;
    }

    textarea {
        height: 287px;
    }
    </style>
HTML;
}

function getScripts(): string
{
    return <<<'HTML'
    <script>
        let coll = document.getElementsByClassName("collapsibleButton");
        let i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
HTML;
}

function getCurrentRequestInfo(): string
{
    $request = getCurrentRequest();
    return sprintf("
        <h3 class='highlightText'>Current Request Info</h3>
        <p class='genericText'>Name: <span class='highlightText'>%s</span></p>
        <p class='genericText'>Url: <a href='%s' class='highlightText'>%s</a></p>
        <p class='genericText'>Unique Id:<span class='highlightText'>%s</span></p>
        ",
        $request->getName(),
        $request->getUrl(),
        $request->getUrl(),
        $request->getUniqueId()
    );
}

function getStoredRequestMenu(ComponentCrud $crud): string
{
    $added = [];
    $menu = '<ul>';
    $requests = $crud->readAll(REQUEST_LOCATION, REQUEST_CONTAINER);
    if (empty($requests) === true) {
        return '';
    }
    /**
     * @var WebRequestComponent $request
     */
    foreach ($requests as $request) {
        if (in_array($request->getUrl(), $added, true)) {
            continue;
        }
        array_push($added, $request->getUrl());
        $menu .= '<li><a href="' . $request->getUrl() . '">' . $request->getName() . '</a></li>';
    }
    $menu .= '</ul>';
    return '<div class="genericText">' . $menu . '</div>';
}

function getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest(): string
{
    $output = '';
    $templates = getTemplatesFromResponsesToCurrentRequest(getMockCrud());
    $content = getOutputComponentsFromResponsesToCurrentRequest(getMockCrud());
    foreach ($templates as $template) {
        /**
         * @var StandardUITemplate $template
         */
        foreach ($template->getTypes() as $type) {
            /**
             * @var OutputComponentInterface $outputComponent
             */
            foreach ($content[$type] as $outputComponent) {
                $output .= (formatOutput() === true ? getOutputComponentInfo($outputComponent) : $outputComponent->getOutput());
            }
        }
    }
    if (getCurrentRequest()->getUrl() !== 'http://192.168.33.10/WorkingDemo.php' && (count(getCurrentRequest()->getGet()) > 0) === true) {
        $output .= getScripts();
    }
    return $output;
}

function getForm(): string
{
    return '
        <p class="genericText">
            The <a href="#form">form</a> below can be used to generate a <span class="highlightText">Response</span> to a
            <span class="highlightText"> Request</span>. The form allows you to specify the<span class="highlightText"> Request\'s</span>
            Url, the <span class="highlightText">Request\'s</span> Name, and the Output that should be
            shown in <span class="highlightText">Response</span> to the <span class="highlightText">Request</span>.<br>
            <span class="noticeText miniText">Note: The form provides default values so if your in a hurry you can
            just click the <span class="highlightText">"Generate Stored Components For Mock Request"</span> button.</span>
        </p>
        <form id="form" class="genericContainer" action="/WorkingDemo.php" method="post">

            <div class="submitButtonContainer">
                <input type="submit" value="Generate Stored Components For Mock Request">
            </div>

            <div class="textInputContainer">
                <label class="formLabelText" for="requestUrl">Request Url:</label>
                <input class="input textInput" type="text" id="requestUrl" name="requestUrl" value="http://192.168.33.10/WorkingDemo.php">
            </div>

            <div class="textInputContainer">
                <label class="formLabelText" for="requestName">Request Name:</label>
                <input class="input textInput" type="text" id="requestName" name="requestName" value="Working Demo">
            </div>

            <div class="selectMenuContainer" style="margin-top: 1em; margin-right:5em; float: right;">
                <span class="formLabelText">Output Position <span class="highlightText">( Relative to other existing output )</span> :</span>
                ' . getPositionSelector() . '
            </div>

            <div class="textAreaContainer">
                <label class="formLabelText" for="output">Output to show in Response to this Request:</label><br>
                <textarea class="input textareaInput" id="output" name="output">' . getDefaultTextAreaContent() . '</textarea>
            </div>

            <div style="clear: both"></div>

            <input type="hidden" name="requestLocation" value="' . REQUEST_LOCATION . '">
            <input type="hidden" name="requestContainer" value="' . REQUEST_CONTAINER . '">

            <div class="submitButtonContainer">
                <input type="submit" value="Generate Stored Components For Mock Request">
            </div>
        </form>
    ';
}

function getDefaultTextAreaContent()
{
    return '<h2 class="highlightText">Title</h2>
<p class="successText">Quos omnis omnis aut fugit mollitia debitis iusto. Non harum eos eligendi aut aut expedita. Consequatur qui dolorem consequatur incidunt temporibus nam quasi et.</p>
<table class="genericContainer">
  <tr>
    <td class="genericContainer genericText">Generic Text Color</td>
    <td class="genericContainer noticeText">Notice Text Color</td>
    <td class="genericContainer warningText">Warning Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer errorText">Error Text Color</td>
    <td class="genericContainer successText">Success Text Color</td>
    <td class="genericContainer failureText">Failure Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer formLabelText">Form Label Text Color</td>
    <td class="genericContainer highlightText">Highlight Text Color</td>
    <td class="genericContainer genericText miniText">Mini Text Size</td>
  </tr>
</table>';
}

function getPositionSelector(): string
{
    $options = [];
    for ($i = 0; $i <= 500; $i++) {
        array_push($options, sprintf('<option>%s</option>', strval(($i / 100))));
    }
    return sprintf('<select name="position">%s</select>', implode(PHP_EOL . '    ', $options));
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

function getMockTemplate(): StandardUITemplate
{
    $template = new \DarlingCms\classes\component\Template\UserInterface\StandardUITemplate(
        new Storable('MockTemplate', TEMPLATE_LOCATION, TEMPLATE_CONTAINER),
        new Switchable(),
        new Positionable()
    );
    $template->addType(getMockOutputComponent());
    return $template;
}

function getMockOutputComponent(): OutputComponentInterface
{
    $outputComponent = new OutputComponent(
        new Storable(
            generateOutputNameFromPostIfSet(),
            OUTPUT_COMPONENT_LOCATION,
            OUTPUT_COMPONENT_CONTAINER
        ),
        new Switchable(),
        new Positionable(generatePositionFromPostIfSet())
    );
    $outputComponent->import(
        [
            'output' => generateOutputFromPostIfSet($outputComponent),
        ]
    );
    return $outputComponent;
}

function generateAndStoreRequest(ComponentCrud $crud, string $url, string $name, string $location, string $container): WebRequestComponent
{
    $request = new Request(
        new Storable($name, $location, $container),
        new Switchable()
    );
    $request->import(['url' => $url]);
    $crud->create($request);
    return $request;
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

function getCurrentRequest(): Request
{
    try {
        return new Request(
            new Storable(
                'Current Request ' . strrev(base64_encode(random_bytes(9))),
                REQUEST_LOCATION,
                REQUEST_CONTAINER),
            new Switchable()
        );
    } catch (Exception $e) {
        error_log('Failed to generate random name for current request using random_bytes(). This is NOT important.', E_NOTICE);
        return new Request(
            new Storable(
                'Current Request (Name Not Unique!)',
                REQUEST_LOCATION,
                REQUEST_CONTAINER),
            new Switchable()
        );
    }
}

function getOutputComponentInfo(OutputComponentInterface $outputComponent): string
{
    return sprintf(
        "<button type='button' class='genericContainer collapsibleButton'>Show / Hide Output Component Info</button>
                 <div class='genericContainer collapsibleContent outputComponentInfo'>
                     <h3 class='noticeText'>Output Component Info</h3>
                     <ul>
                         <li class='noticeText'>Name: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Type: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Unique Id: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Location: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Container: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Type: <span class='highlightText'>%s</span></li>
                         <li class='noticeText'>Position: <span class='highlightText'>%s</span></li>
                     </ul>
                 <h4 class='highlightText'>Output:</h4>
                 %s
                 </div>
                 ",
        $outputComponent->getName(),
        $outputComponent->getType(),
        $outputComponent->getUniqueId(),
        $outputComponent->getLocation(),
        $outputComponent->getContainer(),
        ($outputComponent->getState() === true ? 'True (On)' : 'False (Off)'),
        strval($outputComponent->getPosition()),
        $outputComponent->getOutput()
    );
}

function generateOutputFromPostIfSet(OutputComponentInterface $outputComponent): string
{
    return (
    empty(getCurrentRequest()->getPost() === false)
        ? getCurrentRequest()->getPost()['output']
        : sprintf(
        "Some mock output from output component with id: <span class=\"highlightText miniText\">%s</span>",
        $outputComponent->getUniqueId()
    )
    );
}

function generatePositionFromPostIfSet(): float
{
    return (empty(getCurrentRequest()->getPost() === false)
        ? floatval(getCurrentRequest()->getPost()['position'])
        : 0
    );
}

function generateOutputNameFromPostIfSet(): string
{
    return (
    empty(getCurrentRequest()->getPost()) === false && getCurrentRequest()->getPost()['requestName'] !== 'Mock Request'
        ? getCurrentRequest()->getPost()['requestName']
        : "MockOutputComponent" . strval(rand(100, 999))
    );
}

function getResponsesToCurrentRequest(ComponentCrud $crud): array
{
    $responses = [];
    $storedResponses = $crud->readAll(RESPONSE_LOCATION, RESPONSE_CONTAINER);
    foreach ($storedResponses as $response) {
        if ($response->respondsToRequest(getCurrentRequest(), getMockCrud()) === true) {
            array_push($responses, $response);
        }
    }
    return $responses;
}

function getOutputComponentsFromResponsesToCurrentRequest(ComponentCrud $crud): array
{
    $content = [];
    /**
     * @var WebResponseComponent $response
     */
    foreach (getResponsesToCurrentRequest($crud) as $response) {
        foreach ($response->getOutputComponentStorageInfo() as $storable) {
            /**
             * @var OutputComponentInterface $oc
             */
            $oc = $crud->read($storable);
            while (isset($content[$oc->getType()][strval($oc->getPosition())]) === true) {
                $oc->increasePosition();
            }
            $content[$oc->getType()][strval($oc->getPosition())] = $oc;
            ksort($content[$oc->getType()]);
        }
    }
    return $content;
}

function getTemplatesFromResponsesToCurrentRequest(ComponentCrud $crud): array
{
    $templates = [];
    /**
     * @var WebResponseComponent $response
     */
    // @todo Use Router::getResponses() | Demo is not using a Router at all right now, it should!
    foreach (getResponsesToCurrentRequest($crud) as $response) {
        foreach ($response->getTemplateStorageInfo() as $storable) {
            /**
             * @var StandardUITemplate $template
             */
            $template = $crud->read($storable);
            while (isset($templates[strval($template->getPosition())])) {
                $template->increasePosition();
            }
            $templates[strval($template->getPosition())] = $template;
        }
    }
    //return $templates;
    // for now just return first template since all output components are the same type at the moment, this
    // will prevent output components from showing multiple times if there are multiple templates
    // Note: This is done this way for demonstration purposes only, in general the code in WorkingDemo.php
    // is simply currently meant to demo some of the finished DCMS components...
    return (isset($templates[0]) ? [$templates[0]] : $templates);
}
