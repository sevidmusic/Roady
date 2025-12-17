<?php

use Darling\RoadyRoutingUtilities\classes\requests\Request as Request;
use Darling\PHPJsonUtilities\classes\encoded\data\Json as Json;

$currentRequest = new Request();

?>
<button type="button" class="collapse-content-trigger">Show Current Request Data</button>
<div class="roady-ui-content-wrapper collapsible-content">
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
echo htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8", false);
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
<script>
var coll = document.getElementsByClassName("collapse-content-trigger");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
      content.style.overflow = "auto";
    }
  });
}
</script>
