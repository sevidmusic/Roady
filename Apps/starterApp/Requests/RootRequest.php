<?php

$rootRequest = $appComponentsFactory->buildRequest(
    'RootRequest',
    'Requests',
    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/',
);
