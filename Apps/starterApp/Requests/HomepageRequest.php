<?php

$homepageRequest = $appComponentsFactory->buildRequest(
    'HomepageRequest',
    'Requests',
    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php',
);
