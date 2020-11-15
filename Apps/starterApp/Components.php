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

require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Welcome.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/ResponseOverview.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/ClosingBodyTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/ClosingHtmlTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Doctype.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/OpeningHtmlTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/OpeningHeadTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Title.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Meta.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Stylesheets.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/ClosingHeadTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/OpeningBodyTag.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/OutputComponentOverview.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/MainMenu.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'OutputComponents/Logo.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Requests/Homepage.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Requests/RootRequest.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Requests/ResponseOverviewRequest.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Requests/OutputComponentOverview.php';

require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/OpeningHtml.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/LogoMainMenu.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/Homepage.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/OutputComponentOverview.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/ResponseOverview.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Responses/ClosingHtml.php';

$appComponentsFactory->buildLog(
    AppComponentsFactory::SHOW_LOG | AppComponentsFactory::SAVE_LOG
);

