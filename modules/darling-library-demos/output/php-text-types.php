<?php

use Darling\PHPTextTypes\classes\strings\AlphanumericText;
use Darling\PHPTextTypes\classes\strings\ClassString;
use Darling\PHPTextTypes\classes\strings\Id;
use Darling\PHPTextTypes\classes\strings\Name;
use Darling\PHPTextTypes\classes\strings\SafeText;
use Darling\PHPTextTypes\classes\strings\Text;
use Darling\PHPTextTypes\classes\strings\UnknownClass;
use Darling\RoadyRoutingUtilities\classes\requests\Request;

// Uncomment to enable error error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
function highlgihtText(string $text): string
{
    return '<span style="background: #050505; color: lightblue;">'.$text.'</span>';
}

$currentRequest = new Request();

$defaultText = ', . / ; \' [ ] \ = - 0 9 8 7 6 5 4 3 2 1 รักเท่านั้น  '
    .'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z! @ # $ '
    .'% ^ & * รักเท่านั้น ( ) _ + | } { " : ? > < ~ ` a b c d e f g h'
    .'i j k l m n o p q r s t u v w x y z ';

$rawText = (
    is_string($currentRequest->postArray()['php-text-types-raw-text'])
    ? $currentRequest->postArray()['php-text-types-raw-text']
    : $defaultText
);

$text = new Text($rawText);

$alphanumericText = new AlphanumericText($text);

$nameText = new Name($text);

$safeText = new SafeText($text);

$idText = new Id();

$classString = new ClassString($currentRequest);

$unknownClass = new UnknownClass();

?>
<div class="roady-ui-content-wrapper">
    <h2>Raw Text</h2>
    <form action="?request=php-text-types" method="post">
      <label for="fname">Enter some text to test how it is output by the Basic Text types:</label><br>
      <textarea id="w3review" name="php-text-types-raw-text" rows="5" cols="50">
          <?php echo htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false); ?>
      </textarea><br>
      <input type="submit" value="Test Text">
      <input type="hidden" name="request" value="php-text-types">
    </form>
    </div>
    <div class="roady-ui-content-wrapper">
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
                <br>
<?php
$msg = 'Text represents a string, can be cast to the string it'
       .'represents, and can provide information about the string it'
       .'represents.';
echo highlgihtText($msg);
?>
            </td>
            <td>
                <?php echo htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false); ?>
            </td>
            <td>
                <?php echo $text->length(); ?>
            </td>
        </tr>
        <!-- SafeText -->
        <tr>
            <td>
                <?php echo $safeText::class; ?>
                <br>
<?php
$msg = 'SafeText is used to provide a safe form of Text that may '
.'contain unsafe characters.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'The following characters are considered safe:';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = '- Alphanumeric characters: A-Z, a-z, and 0-9';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = '- Underscores: _';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = '- Hyphens: -';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = '- Periods: .';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'Unsafe characters will be replaced with underscores.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'A consecutive sequence of 2 or more unsafe characters will '
.'be replaced by a single underscore.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'A consecutive sequence of 2 or more underscores will be '
.'replaced by a single underscore.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'A consecutive sequence of 2 or more hyphens will be replaced '
.'by a single hyphen.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'A consecutive sequence of 2 or more periods will be replaced '
.'by a single period.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'SafeText will never be empty, if the original Text is empty, '
       .'then the SafeText will be the numeric character 0.';
echo highlgihtText($msg);
?>
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
                <br>
<?php
$msg = 'AlphanumericText is SafeText that only contains '
       .'alphanumeric characters: a-z, A-Z, and 0-9';
echo highlgihtText($msg);
?>
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
                <br>
<?php
$msg = 'A Name is SafeText that begins with an alphanumeric '
       .'character,  is at least 1 character in length, is no '
       .'more than 170 characters in length, and only contains '
       .'the following characters:';

echo highlgihtText($msg);
?>
            </td>
            <td>
                <?php echo $nameText; ?>
            </td>
            <td>
                <?php echo $nameText->length(); ?>
            </td>
        </tr>
    </table>
</div>
<div class="roady-ui-content-wrapper">
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
                <br>
<?php
$msg = 'An Id is AlphanumericText whose length is between 60 and 80 '
       .'characters.';
echo highlgihtText($msg);
?>
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
                <br>
<?php
$msg = 'A ClassString is the fully qualified namespace and class '
       .'name of an existing Class that is not abstract.';
echo highlgihtText($msg);
?>
            <br>
<?php
$msg = 'If type is not found, then the fully qualified class name of '
       .'the UnknownClass type will be output';
echo highlgihtText($msg);
?>
            </td>
            <td>
                <?php echo $classString; ?>
            </td>
            <td>
                <?php echo $classString->length(); ?>
            </td>
        </tr>
        <!-- UnknownClass -->
        <tr>
            <td>
                <?php echo $unknownClass::class; ?>
                <br>
<?php
$msg = 'An UnknownClass is a ClassString that represents an unknown '
       .'class.';
echo highlgihtText($msg);
?>
            </td>
            <td>
                <?php echo $unknownClass; ?>
            </td>
            <td>
                <?php echo $unknownClass->length(); ?>
            </td>
        </tr>
    </table>
    <p style="margin: 0; padding: 0;">Output from file <code>modules/darling-library-demos/output/php-text-types.php</code></p>
</div>


