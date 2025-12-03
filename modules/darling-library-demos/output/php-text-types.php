<?php

use Darling\PHPTextTypes\classes\strings\SafeText as SafeText;
use Darling\PHPTextTypes\classes\strings\Text as Text;
use Darling\PHPTextTypes\classes\strings\Id as Id;
use Darling\PHPTextTypes\classes\strings\ClassString as ClassString;
use Darling\PHPTextTypes\classes\strings\UnknownClass as UnknownClass;
use Darling\PHPTextTypes\classes\strings\AlphanumericText as AlphanumericText;
use Darling\PHPTextTypes\classes\strings\Name as Name;
use Darling\RoadyRoutingUtilities\classes\requests\Request as Request;

$currentRequest = new \Darling\RoadyRoutingUtilities\classes\requests\Request();
$defaultText = 'A ! B @ C # D $ E % F ^ G & * ( ) รักเท่านั้น _ + | } { \ [ ] ? > < , . / \' " G F E D C B A';
$rawText = ($currentRequest->postArray()['php-text-types-raw-text'] ?? $defaultText);
$text = new Text($rawText);
$alphanumericText = new AlphanumericText($text);
$nameText = new Name($text);
$safeText = new SafeText($text);
$idText = new Id();
$classString = new ClassString($currentRequest);
$unknownClass = new UnknownClass();
?>

<div class="roady-ui-content-wrapper">

<form action="?request=php-text-types" method="post">
  <label for="fname">Enter some text to test:</label><br>
  <textarea id="w3review" name="php-text-types-raw-text" rows="5" cols="50">
      <?php echo $text->__toString(); ?>
  </textarea><br>
  <input type="submit" value="Test Text">
  <input type="hidden" name="request" value="php-text-types">
</form> 
<h2>Basic Text Types</h2>
<table>
    <tr>
        <th>Text Type</th>
        <th>Output</th>
        <th>Length</th>
    </tr>
    <!-- Text -->
    <tr>
        <td>
            <?php echo $text::class; ?>
        </td>
        <td>
            <?php echo $text; ?>
        </td>
        <td>
            <?php echo $text->length(); ?>
        </td>
    </tr>
    <!-- SafeText -->
    <tr>
        <td>
            <?php echo $safeText::class; ?>
        </td>
        <td>
            <?php echo $safeText; ?>
        </td>
        <td>
            <?php echo $safeText->length(); ?>
        </td>
    </tr>
    <!-- AlphanumericText -->
    <tr>
        <td>
            <?php echo $alphanumericText::class; ?>
        </td>
        <td>
            <?php echo $alphanumericText; ?>
        </td>
        <td>
            <?php echo $alphanumericText->length(); ?>
        </td>
    </tr>
    <!-- Name -->
    <tr>
        <td>
            <?php echo $nameText::class; ?>
        </td>
        <td>
            <?php echo $nameText; ?>
        </td>
        <td>
            <?php echo $nameText->length(); ?>
        </td>
    </tr>
</table>
<h2>Other Text types</h2>
<table>
    <tr>
        <th>Text Type</th>
        <th>Output</th>
        <th>Length</th>
    </tr>
    <!-- Id -->
    <tr>
        <td>
            <?php echo $idText::class; ?>
        </td>
        <td>
            <?php echo $idText; ?>
        </td>
        <td>
            <?php echo $idText->length(); ?>
        </td>
    </tr>
    <!-- ClassString -->
    <tr>
        <td>
            <?php echo $classString::class; ?>
        </td>
        <td>
            <?php 
                echo $classString . PHP_EOL . '<br>' .
                '<span style="background: gray; color: lightblue;"> --- Note: ClassString will output the fully qualified class name of whatever type of object was used to instantiate it. If type is not found, then the fully qualified class name of the UnknownClass type will be output</span>'; 
            ?>
        </td>
        <td>
            <?php echo $classString->length(); ?>
        </td>
    </tr>
    <!-- UnknownClass -->
    <tr>
        <td>
            <?php echo $unknownClass::class; ?>
        </td>
        <td>
            <?php echo $unknownClass; ?>
        </td>
        <td>
            <?php echo $unknownClass->length(); ?>
        </td>
    </tr>
</table>
</div>


