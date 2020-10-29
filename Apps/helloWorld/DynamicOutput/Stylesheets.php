<?php
$path = str_replace('DynamicOutput', 'css', __DIR__);
$stylesheets = array_diff(scandir($path), array('.', '..'));

foreach($stylesheets as $stylesheet)
{
    echo '<link rel="stylesheet" href="' . $path . DIRECTORY_SEPARATOR . $stylesheet . '">';
}
