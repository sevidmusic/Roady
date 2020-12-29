<?php

/** APP_NAME | REQUEST_NAME.php */

$appComponentsFactory->buildRequest(
    'REQUEST_NAME',
    'REQUEST_CONTAINER',
    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/RELATIVE_URL',
);
