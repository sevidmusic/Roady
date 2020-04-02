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

require(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/DemoConstants.php');
var_dump(DEMO_SITE_NAME);
$crud = new ComponentCrud(
    new Storable('DefaultCrud', DEMO_SITE_NAME, DEMO_SITE_CRUD_CONTAINER),
    new Switchable(),
    new Standard(
        new Storable('DefaultStorageDriver', DEMO_SITE_NAME, DEMO_SITE_STORAGE_DRIVER_CONTAINER),
        new Switchable()
    )
);

$request = new Request(
    new Storable('Homepage', DEMO_SITE_NAME, DEMO_SITE_REQUEST_CONTAINER),
    new Switchable()
);
$request->import(['url' => 'http://192.168.33.10/index.php']);


$welcomeMessage = new OutputComponent(
    new Storable('WelcomeMessage', DEMO_SITE_NAME, DEMO_SITE_OUTPUT_COMPONENT_CONTAINER),
    new Switchable(),
    new Positionable(0)
);
$welcomeMessage->import(['output' => '<h1 class="successText">Welcome to the Darling Data Management System</h1>']);

$template = new StandardUITemplate(
    new Storable('HomepageTemplate', DEMO_SITE_NAME, DEMO_SITE_TEMPLATE_CONTAINER),
    new Switchable(),
    new Positionable(0)
);
$template->addType($welcomeMessage);

$response = new Response(
    new Storable('Homepage', DEMO_SITE_NAME, DEMO_SITE_RESPONSE_CONTAINER),
    new Switchable()
);
$response->addRequestStorageInfo($request);
$response->addOutputComponentStorageInfo($welcomeMessage);
$response->addTemplateStorageInfo($template);

$crud->create($request);
$crud->create($welcomeMessage);
$crud->create($template);
$crud->create($response);
var_dump($crud->readAll(DEMO_SITE_NAME, DEMO_SITE_OUTPUT_COMPONENT_CONTAINER));