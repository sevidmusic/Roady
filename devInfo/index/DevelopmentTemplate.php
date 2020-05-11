<?php

$crud = new ComponentCrud(
    new Storable('Temp', 'Temp', 'Temp'),
    new Switchable(),
    new Standard(
        new Storable('Temp', 'Temp', 'Temp'),
        new Switchable()
    )
);
$currentRequest = new Request(
    new Storable('Temp', 'Temp', 'Temp'),
    new Switchable()
);
$router = new Router(
    new Storable('Temp', 'Temp', 'Temp'),
    new Switchable(),
    $currentRequest,
    $crud
);
$userInterface = new StandardUI(
    new Storable('Temp', 'Temp', 'Temp'),
    new Switchable(),
    new Positionable(),
    $router,
    App::deriveAppLocationFromRequest($currentRequest),
    Response::RESPONSE_CONTAINER
);
echo $userInterface->getOutput();
