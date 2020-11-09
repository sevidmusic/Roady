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
<div class="output font-concert-one">
<h2 class="overview-title font-audio-wide">Responses</h2>
<?php
    $bgcolors = ['#000000', '#333333'];
    $bgcolor = ['#000000'];
    foreach($crud->readAll($this->getLocation(), Response::RESPONSE_CONTAINER) as $response) {
        $bgcolor = ($bgcolor === $bgcolors[0] ? $bgcolors[1] : $bgcolors[0]);
        echo '
    <div class="component-info highlight-text-color" style="background: ' . $bgcolor . ';">
        <p>Name: <span class="default-text-color">' . $response->getName() . '</span></p>
        <p>Unique Id: <span class="default-text-color">' . substr($response->getUniqueId(), 0, 17) . '...</span></p>
        <p>Storage Location: <span class="default-text-color">' . $response->getLocation() . '</span></p>
        <p>Storage Container: <span class="default-text-color">' . $response->getContainer() . '</span></p>
        <p>Position: <span class="default-text-color">' . $response->getPosition() . '</span></p>
        <p>Type: <span class="default-text-color">' . $response->getType() . '</span></p>
    </div>
            ';
    }
?>
</div>

