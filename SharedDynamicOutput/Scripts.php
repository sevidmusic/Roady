<?php
$path = str_replace('SharedDynamicOutput', 'Apps' . DIRECTORY_SEPARATOR . $this->appDirectoryName . DIRECTORY_SEPARATOR . 'js', __DIR__);
$scripts = array_diff(scandir($path), array('.', '..'));

foreach($scripts as $script)
{
    echo '<script src="' . 'Apps/helloWorld/js/' . $script. '"></script>';
}
