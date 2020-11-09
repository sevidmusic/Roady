<?php

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
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
    <div class="component-info font-audio-wide code-text-color">
        <h3>"Output Component Overview" Component's Info</h3>
        <p>Name: <?php echo $this->getName(); ?></p>
        <p>Type: <?php echo $this->getType(); ?></p>
        <p>Unique Id: <?php echo substr($this->getUniqueId(), 0, 17); ?>...</p>
        <p>Storage Location: <?php echo $this->getLocation(); ?></p>
        <p>Storage Container: <?php echo $this->getContainer(); ?></p>
    </div>
</div>

