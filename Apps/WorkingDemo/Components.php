<?php

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

ini_set('display_errors', true);
require '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . "Settings.php";


function getPositionSelector(): string
{
    $options = [];
    for ($i = 0; $i <= 500; $i++) {
        array_push($options, sprintf('<option>%s</option>', strval(($i / 100))));
    }
    return sprintf('<select name="position">%s</select>', implode(PHP_EOL . '    ', $options));
}

/***** OUTPUT COMPONENTS *****/
/**
 * Doctype
 */
$doctype = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoDoctype",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(0)
);
$doctype->import(['output' => '<!DOCTYPE html><html lang="en">']);

/**
 * Html <head>
 */
$htmlHead = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlHead",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(1)
);

$htmlHead->import(['output' => <<<'HTML'
<head>
    <title>Darling Cms Redesign | Dev Request -> Router <- Response Interactions</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
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
</head>
HTML
]);

/**
 * Html <body>
 */
$htmlBody = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlBody",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(2)
);

// Hint: You could place the default HTML in a file, and use file_get_contents() to read html and import as output
// $htmlBody->import(['output' => file_get_contents("path/to/html/file.html");
$htmlBody->import(['output' => '
<body class="gradientBg">
<div id="welcome" class="genericContainer genericContainerLimitedHeight"><h1 class="noticeText">Welcome</h1>
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
        is/are used to generate output for the <span class="highlightText"> Request</span>, and which <span
                class="highlightText"> Template(s)</span> is/are used to
        organize that output.
    </p></div>
<div id="formContainer" class="genericContainer genericContainerLimitedHeight">
    <p class="genericText">
        The <a href="#form">form</a> below can be used to generate a <span class="highlightText">Response</span> to a
        <span class="highlightText"> Request</span>. The form allows you to specify the<span class="highlightText"> Request\'s</span>
        Url, the <span class="highlightText">Request\'s</span> Name, and the Output that should be
        shown in <span class="highlightText">Response</span> to the <span class="highlightText">Request</span>.<br>
        <span class="noticeText miniText">Note: The form provides default values so if your in a hurry you can
            just click the <span
                    class="highlightText">"Generate Stored Components For Mock Request"</span> button.</span>
    </p>
    <form id="form" class="genericContainer" action="/WorkingDemo.php" method="post">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>

        <div class="textInputContainer">
            <label class="formLabelText" for="requestUrl">Request Url:</label>
            <input class="input textInput" type="text" id="requestUrl" name="requestUrl"
                   value="http://192.168.33.10/WorkingDemo.php">
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
            <textarea class="input textareaInput" id="output" name="output"><h2 class="highlightText">Title</h2>
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
</table></textarea>
        </div>

        <div style="clear: both"></div>

        <input type="hidden" name="requestLocation" value="Demo">
        <input type="hidden" name="requestContainer" value="Request">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>
    </form>
</div>
<div id="requestMenu" class="genericContainer genericContainerLimitedHeight">
    <h3 class=\'highlightText\'>Current Request Info</h3>
    <p class=\'genericText\'>Name: <span class=\'highlightText\'>Current Request WNuL6lOCq1xF</span></p>
    <p class=\'genericText\'>Url: <a href=\'http://192.168.33.10/WorkingDemo.php\' class=\'highlightText\'>http://192.168.33.10/WorkingDemo.php</a>
    </p>
    <p class=\'genericText\'>Unique Id:<span class=\'highlightText\'>eEsQvafpEeR5WJfwUudTRwjia4pk3kFz2OjoTFpCrb3FvqGx1Q63FL4WdGMJjc2f6QXrjytmSFvV2LexelAFJo5PinfCOovsuEmtnzQGIdVfsLtuApCVORJmzPdvUxu2</span>
    </p>
</div>


<script>
    let coll = document.getElementsByClassName("collapsibleButton");
    let i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
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

</body>'
]);

$finalOutput = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlFinalOutput",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(3)
);
$finalOutput->import(['output' => '</html><!-- this html was generated by Darling Data Management System Components configured by the WorkingDemo App -->']);

/***** StandardUITemplates *****/
$workingDemoDefaultTemplate = new StandardUITemplate(
    new Storable(
        DEMO_SITE_NAME . 'StandardUITemplate',
        DEMO_SITE_NAME,
        DEMO_SITE_TEMPLATE_CONTAINER
    ),
    new Switchable(),
    new Positionable(0)
);
// All the OutputComponents defined at the moment are same type so we
// only new to call addType() on one of them, if there were different
// types of OutputComponents used then each type would need to be added
// to be represented in the Template.
$workingDemoDefaultTemplate->addType($finalOutput);

// Request
$workingDemoDefaultRequest = new Request(
    new Storable(
        DEMO_SITE_NAME . 'Request',
        DEMO_SITE_NAME,
        DEMO_SITE_REQUEST_CONTAINER
    ),
    new Switchable()
);
$workingDemoDefaultRequest->import(['url' => 'http://192.168.33.10/index.php?WorkingDemo']);

// Response
$workingDemoDefaultResponse = new Response(
    new Storable(
        DEMO_SITE_NAME . 'Response',
        DEMO_SITE_NAME,
        DEMO_SITE_RESPONSE_CONTAINER
    ),
    new Switchable()
);
$workingDemoDefaultResponse->addRequestStorageInfo($workingDemoDefaultRequest);
$workingDemoDefaultResponse->addTemplateStorageInfo($workingDemoDefaultTemplate);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($doctype);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($htmlHead);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($htmlBody);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($finalOutput);

$componentCrud = new ComponentCrud(
    new Storable(
        DEMO_SITE_NAME . 'Crud',
        DEMO_SITE_NAME,
        DEMO_SITE_CRUD_CONTAINER),
    new Switchable(),
    new Standard(
        new Storable(
            DEMO_SITE_NAME . 'StorageDriver',
            DEMO_SITE_NAME,
            DEMO_SITE_STORAGE_DRIVER_CONTAINER
        ),
        new Switchable()
    )
);

$components = [
    $workingDemoDefaultRequest,
    $workingDemoDefaultResponse,
    $workingDemoDefaultTemplate,
    $doctype,
    $htmlHead,
    $htmlBody,
    $finalOutput
];

foreach ($components as $component) {
    printf(
        "<p>Saving component %s to location <span style='color: purple;'>%s</span> in container <span style='color: green;'>%s</span></p>",
        $component->getName(),
        $component->getLocation(),
        $component->getContainer()
    );
    $componentCrud->create($component);
}

/** Show preview of Output when this file is run *
 * printf(
 * "%s%s%s%s",
 * $doctype->getOutput(),
 * $htmlHead->getOutput(),
 * $htmlBody->getOutput(),
 * $finalOutput->getOutput()
 * );
 */


