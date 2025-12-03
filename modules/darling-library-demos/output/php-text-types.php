<?php

use Darling\PHPTextTypes\classes\strings\Text as Text;

$text = new Text('Some text');
$output = $text->__toString();

?>

<div class="roady-ui-content-wrapper">

<?php echo $output ?>

</div>


