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
$htmlHead->import(
    [
        'output' => file_get_contents(__DIR__ . '/html/HtmlHeadCommon.html')
    ]
);

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

ob_start();
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'html/WorkingDemoHtmlBody.php');
$workingDemoHtml = ob_get_clean();
$workingDemoHtmlBody->import(
    [
        'output' => $workingDemoHtml
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
        ($componentCrud->create($component) === true ? "<p style=\"color: green;\">Saved successfully</p>" : "<p style=\"color: red;\">The component could not be saved</p>")
    );
}

