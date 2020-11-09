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
        <p>Unique Id: <?php echo substr($this->getUniqueId(), 0, 17); ?>...</p>
        <p>Storage Location: <?php echo $this->getLocation(); ?></p>
        <p>Storage Container: <?php echo $this->getContainer(); ?></p>
        <p>Type: <?php echo $this->getType(); ?></p>
    </div>
</div>
<div class="output font-concert-one">
<?php
    $bgcolors = ['#000000', '#333333'];
    $bgcolor = ['#000000'];
    foreach($crud->readAll($this->getLocation(), 'Output') as $outputComponent) {
        if($outputComponent->getName() !== 'OutputComponentOverview') {
            $bgcolor = ($bgcolor === $bgcolors[0] ? $bgcolors[1] : $bgcolors[0]);
            echo '
    <div class="component-info font-audio-wide code-text-color" style="background: ' . $bgcolor . ';">
        <p>Name: ' . $outputComponent->getName() . '</p>
        <p>Unique Id: ' . substr($outputComponent->getUniqueId(), 0, 17) . '...</p>
        <p>Storage Location: ' . $outputComponent->getLocation() . '</p>
        <p>Storage Container: ' . $outputComponent->getContainer() . '</p>
        <p>Position: ' . $outputComponent->getPosition() . '</p>
        <p>Type: ' . $outputComponent->getType() . '</p>
        <p>Output:</p>
        <div class="component-info-output-preview">
        ' . str_replace(['<', '>'], ['&lt;' . '<br>', '&gt;' . '<br>'], $outputComponent->getOutput()) . '
        </div>
    </div>
            ';
        }
    }
?>
</div>

