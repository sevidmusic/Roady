<?php
$path = str_replace('DynamicOutput', 'js', __DIR__);
$scripts = array_diff(scandir($path), array('.', '..'));

foreach($scripts as $script)
{
    echo '<script src="' . 'Apps/helloWorld/js/' . $script. '"></script>';
}
