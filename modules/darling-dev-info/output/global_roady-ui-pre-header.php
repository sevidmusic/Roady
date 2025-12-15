<?php

use Darling\RoadyRoutingUtilities\classes\requests\Request as Request;
use Darling\PHPJsonUtilities\classes\encoded\data\Json as Json;

$currentRequest = new Request();

?>

<div class="roady-ui-content-wrapper">
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
echo str_replace(['DOCTYPE', 'html'], ["--replaced--"], htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8", false))
?>
            </td>
            <td>
<?php
$json = new Json($currentRequest->postArray());
echo htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8", false);
?>
            </td>
        </tr>
    </table>
</div>
