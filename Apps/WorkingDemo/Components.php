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
        "Doctype",
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
        "HtmlHead",
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
$workingDemoHtmlBody = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlBody",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(2)
);

$workingDemoHtmlBody->import(
    [
        'output' => file_get_contents(__DIR__ . '/html/WorkingDemoHtmlBody.html')
    ]
);

$indexHtmlBody = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "IndexHtmlBody",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(2)
);
$indexHtmlBody->import(['output' => '
    <body class="gradientBg">
    <div class="genericContainer successText">
        <p>Welcome</p>
        <p>Use the menu below to navigate around</p>
        <ul>
            <li><a href="http://192.168.33.10/index.php">Home</a></li>
            <li><a href="http://192.168.33.10/">Root</a></li>
            <li><a href="http://192.168.33.10/WorkingDemo.php">Demo</a></li>
            <li><a href="http://192.168.33.10/index.php?WorkingDemo">Installed WorkingDemo App</a></li>
        </ul>
    </div>
    </body>
'
]);


$finalOutput = new OutputComponent(
    new Storable(
        "FinalHtmlOutput",
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(3)
);
$finalOutput->import(['output' => '</html><!-- this html was generated by Darling Data Management System Components configured by the WorkingDemo App -->']);

/***** StandardUITemplates *****/
$standardUITemplate = new StandardUITemplate(
    new Storable(
        'StandardUITemplate',
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
$standardUITemplate->addType($finalOutput);

// Requests
$workingDemoDefaultRequest = new Request(
    new Storable(
        DEMO_SITE_NAME . 'Request',
        DEMO_SITE_NAME,
        DEMO_SITE_REQUEST_CONTAINER
    ),
    new Switchable()
);
$workingDemoDefaultRequest->import(['url' => 'http://192.168.33.10/index.php?WorkingDemo']);

$indexRequest = new Request(
    new Storable(
        'IndexRequest',
        DEMO_SITE_NAME,
        DEMO_SITE_REQUEST_CONTAINER
    ),
    new Switchable()
);
$indexRequest->import(['url' => 'http://192.168.33.10/index.php']);

$rootRequest = new Request(
    new Storable(
        'RootRequest',
        DEMO_SITE_NAME,
        DEMO_SITE_REQUEST_CONTAINER
    ),
    new Switchable()
);
$rootRequest->import(['url' => 'http://192.168.33.10/']);


// Responses
$workingDemoDefaultResponse = new Response(
    new Storable(
        DEMO_SITE_NAME . 'Response',
        DEMO_SITE_NAME,
        DEMO_SITE_RESPONSE_CONTAINER
    ),
    new Switchable()
);
$workingDemoDefaultResponse->addRequestStorageInfo($workingDemoDefaultRequest);
$workingDemoDefaultResponse->addTemplateStorageInfo($standardUITemplate);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($doctype);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($htmlHead);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($workingDemoHtmlBody);
$workingDemoDefaultResponse->addOutputComponentStorageInfo($finalOutput);

$indexResponse = new Response(
    new Storable(
        'IndexResponse',
        DEMO_SITE_NAME,
        DEMO_SITE_RESPONSE_CONTAINER
    ),
    new Switchable()
);
$indexResponse->addRequestStorageInfo($indexRequest);
$indexResponse->addRequestStorageInfo($rootRequest);
$indexResponse->addTemplateStorageInfo($standardUITemplate);
$indexResponse->addOutputComponentStorageInfo($doctype);
$indexResponse->addOutputComponentStorageInfo($htmlHead);
$indexResponse->addOutputComponentStorageInfo($indexHtmlBody);
$indexResponse->addOutputComponentStorageInfo($finalOutput);


$componentCrud = new ComponentCrud(
    new Storable(
        'Crud',
        DEMO_SITE_NAME,
        DEMO_SITE_CRUD_CONTAINER),
    new Switchable(),
    new Standard(
        new Storable(
            'StorageDriver',
            DEMO_SITE_NAME,
            DEMO_SITE_STORAGE_DRIVER_CONTAINER
        ),
        new Switchable()
    )
);

$components = [
    $workingDemoDefaultRequest,
    $indexRequest,
    $rootRequest,
    $workingDemoDefaultResponse,
    $indexResponse,
    $standardUITemplate,
    $doctype,
    $htmlHead,
    $workingDemoHtmlBody,
    $indexHtmlBody,
    $finalOutput
];

foreach ($components as $component) {
    printf(
        "<p>Saving component %s to location <span style='color: purple;'>%s</span> in container <span style='color: green;'>%s</span></p>",
        $component->getName(),
        $component->getLocation(),
        $component->getContainer()
    );
    printf(
        "%s",
        ($componentCrud->create($component) === true ? "<p style=\"color: green;\">Saved successfully</p>" : "<p style=\"color: red;\">The componet could not be saved</p>")
    );
}

/** Show preview of Output when this file is run *
 * printf(
 * "%s%s%s%s",
 * $doctype->getOutput(),
 * $htmlHead->getOutput(),
 * $workingDemoHtmlBody->getOutput(),
 * $finalOutput->getOutput()
 * );
 */


