<?php

ini_set('display_errors', true);
require(__DIR__ . '/DemoConstants.php');
require(__DIR__ . '/DemoFunctions.php');

processFormIfSubmitted(getMockCrud());
echo getHtml();




