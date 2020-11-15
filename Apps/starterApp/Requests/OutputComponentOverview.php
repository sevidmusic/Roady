<?php

$outputComponentOverviewRequest = $appComponentsFactory->buildRequest(
    'OutputComponentOverviewRequest',
    'Requests',
    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?outputComponentOverview',
);
