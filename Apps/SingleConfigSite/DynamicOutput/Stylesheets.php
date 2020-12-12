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
<?php
/*    <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert%20One' rel='stylesheet'>
*/
?>
    <link href="./Apps/SingleConfigSite/css/backgrounds.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/borders.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/colors.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/dimensions.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/globalAnimations.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/links.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/lists.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/marginsPadding.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/rendering.css" rel="stylesheet">
    <link href="./Apps/SingleConfigSite/css/text.css" rel="stylesheet">
<?php
    if($currentRequest->getUrl() === $rootUrl) {
        echo '    <link href="./Apps/SingleConfigSite/css/landingPageAnimations.css" rel="stylesheet">' . PHP_EOL;
    }
?>

