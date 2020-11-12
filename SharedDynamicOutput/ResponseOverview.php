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
                    <th class="component-info-table-header-cell">Position</th>
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
                    <td class="component-info-table-cell component-info-table-cell-odd"><a href="./index.php?outputComponentOverview#' . $outputComponent->getUniqueId() . '">' . $outputComponent->getName() . '</a></td>
                    <td class="component-info-table-cell component-info-table-cell-even">' . $outputComponent->getType() . '</td>
                    <td class="component-info-table-cell component-info-table-cell-even">' . $outputComponent->getPosition() . '</td>
                </tr>
        ';
    }
    return $info;
}

function getRequestStorageInfo(ResponseInterface $response, ComponentCrud $crud): string
{
    $header = '<h4 class="request-info-header">Assigned to the following Requests</h4>';
    $info = $header;
    if($response->getType() === 'DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse')
    {
        return $info . '<p class="success-text-color">Global Responses are assigned to all requests</p>';
    }
    foreach($response->getRequestStorageInfo() as $storable)
    {
        $request = $crud->read($storable);
        $info .= '<p><a href="' . $request->getUrl() . '">' . $request->getUrl() .  '</a></p>';
    }
    return ($info === $header ? 'Not assigned to any requests.' : $info);
}

?>
<div class="output font-concert-one">
<h2 class="overview-title font-audio-wide">Responses</h2>
<?php
    $bgClasses = ['group-odd', 'group-even'];
    $bgClass = $bgClasses[1];
    foreach($crud->readAll($this->getLocation(), Response::RESPONSE_CONTAINER) as $response) {
        $bgClass = ($bgClass === $bgClasses[0] ? $bgClasses[1] : $bgClasses[0]);
        echo '
    <div class="component-info highlight-text-color ' . $bgClass . '">
        <p>Name: <span class="default-text-color">' . $response->getName() . '</span></p>
        <p>Unique Id: <span class="default-text-color">' . substr($response->getUniqueId(), 0, 17) . '...</span></p>
        <p>Storage Location: <span class="default-text-color">' . $response->getLocation() . '</span></p>
        <p>Storage Container: <span class="default-text-color">' . $response->getContainer() . '</span></p>
        <p>Position: <span class="default-text-color">' . $response->getPosition() . '</span></p>
        <p>Type: <span class="default-text-color">' . $response->getType() . '</span></p>
        ' . getRequestStorageInfo($response, $crud) . '
        ' . getOutputComponentInfoTable($response, $crud) . '
    </div>
            ';
    }
?>
</div>

