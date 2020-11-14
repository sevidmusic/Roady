<?php

$responseOverviewRequest = $appComponentsFactory->buildRequest(
    'ResponseOverviewRequest',
    'Requests',
    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php?responseOverview',
);
