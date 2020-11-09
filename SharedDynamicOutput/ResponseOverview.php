<?php

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;

$crud = new ComponentCrud(
    new Storable(
        'OCOverviewCrud',
        'Temp',
        'Temp'
    ),
    new Switchable(),
    new JsonStorageDriver(
        new Storable(
            'OCOverviewStorageDriver',
            'Temp',
            'Temp'
        ),
        new Switchable()
    )
);

?>
<h1>RESPONSES</h1>
<div class="output font-concert-one">
<?php
    $bgcolors = ['#000000', '#333333'];
    $bgcolor = ['#000000'];
    foreach($crud->readAll($this->getLocation(), Response::RESPONSE_CONTAINER) as $response) {
        $bgcolor = ($bgcolor === $bgcolors[0] ? $bgcolors[1] : $bgcolors[0]);
        echo '
    <div class="component-info font-audio-wide code-text-color" style="background: ' . $bgcolor . ';">
        <p>Name: ' . $response->getName() . '</p>
        <p>Unique Id: ' . substr($response->getUniqueId(), 0, 17) . '...</p>
        <p>Storage Location: ' . $response->getLocation() . '</p>
        <p>Storage Container: ' . $response->getContainer() . '</p>
        <p>Position: ' . $response->getPosition() . '</p>
        <p>Type: ' . $response->getType() . '</p>
    </div>
            ';
    }
?>
</div>

