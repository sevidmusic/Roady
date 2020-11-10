<?php

use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'Requests',
        'Index'
    ),
    new Switchable()
);

$parsedUrl = parse_url($currentRequest->getUrl());
$rootUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . (isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '') . '/';
?>
    <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert%20One' rel='stylesheet'>
    <link href="./Apps/starterApp/css/textColors.css" rel="stylesheet">
    <link href="./Apps/starterApp/css/textStyles.css" rel="stylesheet">
    <link href="./Apps/starterApp/css/rendering.css" rel="stylesheet">
<?php
    if($currentRequest->getUrl() === $rootUrl) {
        echo '    <link href="./Apps/starterApp/css/landingPageAnimations.css" rel="stylesheet">' . PHP_EOL;
    }
?>

