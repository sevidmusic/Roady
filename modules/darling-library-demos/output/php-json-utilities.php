<?php

use Darling\PHPJsonUtilities\classes\encoded\data\Json as Json;
use Darling\PHPTextTypes\classes\strings\ClassString as ClassString;
use Darling\RoadyRoutingUtilities\classes\requests\Request as Request;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$currentRequest = new Request();
$providedData = ($currentRequest->postArray()['php-json-utilities-raw-data'] ?? '');
$dataType = gettype($providedData);
$jsonForProvidedData = new Json($providedData);
$arrayOfInternallyDefinedData = [
  'Request Url' => $currentRequest->url()->__toString(), 
  'Request Data' => ['post' => $currentRequest->postArray(), 'get' => $currentRequest->getArray()], 
];
$jsonForInternalData = new Json($arrayOfInternallyDefinedData);

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
<h2>Json For Provided Data:</h2>
<table>
    <tr>
        <th>Data Type</th>
        <th>Resulting Json</th>
        <th>Length</th>
    </tr>
    <!-- Json -->
    <tr>
        <td><?php echo $dataType; ?></td>
        <td><?php echo $jsonForProvidedData->__toString(); ?></td>
        <td><?php echo $jsonForProvidedData->length(); ?></td>
    </tr>
</table>
</div>


<div class="roady-ui-content-wrapper">
<h2>Json For Internally Defined Array of Data:</h2>
    <div class="sourceCode">
    <p>[</p>
    <p style="padding-left: 1rem;">'Request' => $currentRequest->url()->__toString()</p>
    <p style="padding-left: 1rem;">'Request Data' => $currentRequest->postArray()</p>
    <p>]</p>
</div>
<table>
    <tr>
        <th>Data Type</th>
        <th>Resulting Json</th>
        <th>Length</th>
    </tr>
    <!-- Json -->
    <tr>
        <td><?php echo gettype($arrayOfInternallyDefinedData); ?></td>
        <td><?php echo $jsonForInternalData->__toString(); ?></td>
        <td><?php echo $jsonForInternalData->length(); ?></td>
    </tr>
</table>
</div>
