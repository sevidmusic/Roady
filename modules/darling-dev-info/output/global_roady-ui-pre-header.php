<?php

use Darling\PHPJsonUtilities\classes\encoded\data\Json;
use Darling\RoadyRoutingUtilities\classes\requests\Request;

$currentRequest = new Request();

?>
<button type="button" class="darling-collapse-content-trigger">Show Current Request Data</button>
<div class="roady-ui-content-wrapper darling-collapsible-content">
    <table>
        <tr>
            <th>Request Url</th>
            <th>Request Get Data</th>
            <th>Request Post Data</th>
        </tr>
        <tr>
            <td><?php echo $currentRequest->url(); ?></td>
            <td>
<?php
$json = new Json($currentRequest->getArray());
echo htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false);
?>
            </td>
            <td>
<?php
$json = new Json($currentRequest->postArray());
echo htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false);
?>
            </td>
        </tr>
    </table>
</div>
