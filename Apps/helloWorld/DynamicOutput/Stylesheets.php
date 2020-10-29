<?php
$path = str_replace('DynamicOutput', 'css', __DIR__);
$stylesheets = array_diff(scandir($path), array('.', '..'));

foreach($stylesheets as $stylesheet)
{
    echo '<link rel="stylesheet" href="Apps/helloWorld/css/' . $stylesheet . '">';
}
