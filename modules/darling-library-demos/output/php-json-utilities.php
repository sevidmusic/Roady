<?php

use Darling\PHPJsonUtilities\classes\encoded\data\Json;
use Darling\RoadyRoutingUtilities\classes\requests\Request;

$currentRequest = new Request();
$providedData = ($currentRequest->postArray()['php-json-utilities-raw-data'] ?? '');
$jsonForProvidedData = new Json($providedData);
$jsonForCurrentRequest = new Json($currentRequest);

?>

<div class="roady-ui-content-wrapper">

<form action="?request=php-json-utilities" method="post">
  <label for="fname">Enter some text or some josn to see how it is encoded by the Json class:</label><br>
  <textarea id="w3review" name="php-json-utilities-raw-data" rows="5" cols="50"></textarea><br>
  <input type="submit" value="Test Data">
  <input type="hidden" name="request" value="php-json-utilities">
</form>
</div>
<div class="roady-ui-content-wrapper">
<p>Json For Provided Data:</p>
    <table>
        <tr>
            <th>Resulting Json</th>
            <th>Length</th>
        </tr>
        <tr>
            <td class="sourceCode">
<?php
echo htmlspecialchars(
    $jsonForProvidedData,
    ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
    'UTF-8',
    false
);
?>
            </td>
            <td><?php echo $jsonForProvidedData->length(); ?></td>
        </tr>
    </table>
</div>

<div class="roady-ui-content-wrapper">
    <p>
        Json for current Request as encoded by a
        <?php echo $jsonForCurrentRequest::class; ?> instance:
    </p>
    <table>
        <tr>
            <th>Json</th>
            <th>Json string length</th>
        </tr>
        <tr>
            <td class="sourceCode">
            <?php echo $jsonForCurrentRequest; ?>
            </td>
            <td><?php echo $jsonForCurrentRequest->length(); ?></td>
        </tr>
    </table>
</div>
