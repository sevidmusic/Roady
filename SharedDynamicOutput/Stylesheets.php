<?php
$path = str_replace('SharedDynamicOutput', 'Apps' . DIRECTORY_SEPARATOR . $this->appDirectoryName . DIRECTORY_SEPARATOR . 'css', __DIR__);
$stylesheets = array_diff(scandir($path), array('.', '..'));

foreach($stylesheets as $stylesheet)
{
    echo '<link rel="stylesheet" href="Apps/helloWorld/css/' . $stylesheet . '">';
}
