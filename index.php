<?php
/** Require Composer's auto-loader. **/
require(__DIR__ . '/vendor/autoload.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Darling Cms Redesign Welcome Page</title>
        <style>
            body {
                background: #000000;
                font-family: monospace;
                color: #293dee;
                font-size: 24px;
            }
        </style>
    </head>
    <body id="animate">
    <?php
        $request = new \DarlingCms\classes\component\Web\Routing\Request(
            new \DarlingCms\classes\primary\Storable('Request', 'Routing', 'Requests'),
            new \DarlingCms\classes\primary\Switchable()
        );
        echo '<p>' . $request->getUrl() . '</p>';
        echo '<ul>';
        foreach($request->getGet() as $key => $value) {
            echo "<li>$key : $value</li>";
        }
        echo '</ul>';
        echo '<ul>';
        foreach($request->getPost() as $key => $value) {
            echo "<li>$key : $value</li>";
        }
        echo '</ul>';

    ?>
    <form method='post'>
        <input type="submit" />
        <input type="hidden" name="hiddenValue" value="someValue" />
    </form>
    </body>
</html>
