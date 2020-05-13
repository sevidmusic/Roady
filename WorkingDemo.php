<?php

ini_set('display_errors', true);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Apps' . DIRECTORY_SEPARATOR . 'WorkingDemo' . DIRECTORY_SEPARATOR . 'DemoFunctions.php');

processFormIfSubmitted(getMockCrud());
echo getHtml();




