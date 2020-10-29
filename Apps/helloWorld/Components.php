<?php

use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;

ini_set('display_errors', true);

require(
    '..' .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

$appComponentsFactory = new AppComponentsFactory(
    ...AppComponentsFactory::buildConstructorArgs(
    AppComponentsFactory::buildDomain('http://localhost:8080')
)
);

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/DoctypeOpenHtmlOpenHead.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/TitleMetaStylesScripts.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/CloseHeadOpenBody.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/CloseBodyCloseHtml.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/MainMenu.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/Homepage.php';

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

