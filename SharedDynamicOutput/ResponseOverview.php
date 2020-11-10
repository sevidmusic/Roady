<?php

use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
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

function getOutputComponentInfoTable(ResponseInterface $response, ComponentCrud $crud): string
{
    return '
            <table class="component-info-table">
                <caption>Assigned Output Components</caption>
                <tr class="component-info-table-row component-info-table-header-row">
                    <th class="component-info-table-header-cell">Name</th>
                    <th class="component-info-table-header-cell">Type</th>
                </tr>
            ' . getOutputComponentInfo($response, $crud) . '
            </table>
    ';
}

function getOutputComponentInfo(ResponseInterface $response, ComponentCrud $crud): string
{
    $info = '';
    foreach($response->getOutputComponentStorageInfo() as $storable)
    {
        $outputComponent = $crud->read($storable);
        $info .= '
                <tr>
                    <td class="component-info-table-cell component-info-table-cell-odd">' . $outputComponent->getName() . '</td>
                    <td class="component-info-table-cell component-info-table-cell-even">' . $outputComponent->getType() . '</td>
                </tr>
        ';
    }
    return $info;
}

?>
<div class="output font-concert-one">
<h2 class="overview-title font-audio-wide">Responses</h2>
<?php
    $bgcolors = ['linear-gradient(90deg, #000000, #090909)', 'linear-gradient(90deg, #090909, #000000)'];
    $bgcolor = $bgcolors[1];
    foreach($crud->readAll($this->getLocation(), Response::RESPONSE_CONTAINER) as $response) {
        $bgcolor = ($bgcolor === $bgcolors[0] ? $bgcolors[1] : $bgcolors[0]);
        echo '
    <div class="component-info highlight-text-color" style="background-image: ' . $bgcolor . ';">
        <p>Name: <span class="default-text-color">' . $response->getName() . '</span></p>
        <p>Unique Id: <span class="default-text-color">' . substr($response->getUniqueId(), 0, 17) . '...</span></p>
        <p>Storage Location: <span class="default-text-color">' . $response->getLocation() . '</span></p>
        <p>Storage Container: <span class="default-text-color">' . $response->getContainer() . '</span></p>
        <p>Position: <span class="default-text-color">' . $response->getPosition() . '</span></p>
        <p>Type: <span class="default-text-color">' . $response->getType() . '</span></p>
        ' . getOutputComponentInfoTable($response, $crud) . '
    </div>
            ';
    }
?>
</div>

