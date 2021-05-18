<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\classes\component\UserInterface\ResponseUI;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\utility\AppBuilder;


##################################################################################################
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;


use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse;

class HtmlStructure {

    private const DARLING_DATA_MANAMENT_SYSTEM = 'HtmlStructure';
    public static function getCurrentRequest(): RequestInterface {
        return new Request(new Storable('CurrentRequest', 'Requests', self::DARLING_DATA_MANAMENT_SYSTEM), new Switchable());
    }

    public static function getAppComponentsFactory(): AppComponentsFactoryInterface {
        return AppBuilder::getAppsAppComponentsFactory(self::DARLING_DATA_MANAMENT_SYSTEM, self::getCurrentRequest()->getUrl());
    }

    public static function getComponentCrud(): ComponentCrudInterface {
        return self::getAppComponentsFactory()->getComponentCrud();
    }

    public static function getPrimaryFactory(): PrimaryFactoryInterface {
        return self::getAppComponentsFactory()->getPrimaryFactory();
    }

    public static function createOrUpdateOutputComponent(string $name, string $container, float $position, string $output): OutputComponentInterface {
        try {
            # OC exists, read from storage, and update position and output to match specified
            /**
             * @var OutputComponent $outputComponent
             */
            $outputComponent = self::getComponentCrud()->readByNameAndType($name, OutputComponent::class, self::getAppComponentsFactory()->getLocation(), $container);
            if($outputComponent->getOutput() !== $output) {
                $outputComponent->import(['output' => $output]);
                $modified = true;
            }
            if($outputComponent->getPosition() !== $position) {
                $outputComponent->import(['positionable' => HtmlStructure::getPrimaryFactory()->buildPositionable($position)]);
                $modified = true;
            }
            if(isset($modified) && $modified === true) {
                 self::getComponentCrud()->update($outputComponent, $outputComponent);
            }
        } catch (\RuntimeException $e) {
            # OC does not exist, create and store it
            $outputComponent = self::getAppComponentsFactory()->buildOutputComponent($name, $container, $output, $position);
        }
        return $outputComponent;
    }

    public static function createOrUpdateGlobalResponse(string $name, float $position, OutputComponentInterface ...$outputComponents): GlobalResponseInterface {
        try {
            # OC exists, read from storage, and update position and output to match specified
            /**
             * @var GlobalResponseInterface $globalResponse
             */
            $globalResponse = self::getComponentCrud()->readByNameAndType($name, GlobalResponse::class, self::getAppComponentsFactory()->getLocation(), GlobalResponse::RESPONSE_CONTAINER);
            foreach($outputComponents as $outputComponent) {
                if(!in_array($outputComponent->export()['storable'], $globalResponse->getOutputComponentStorageInfo())) {
                    $globalResponse->addOutputComponentStorageInfo($outputComponent);
                    $modified = true;
                }
            }
            if(isset($modified) && $modified === true) {
                self::getComponentCrud()->update($globalResponse, $globalResponse);
            }
        } catch (\RuntimeException $e) {
            # OC does not exist, create and store it
            $globalResponse = self::getAppComponentsFactory()->buildGlobalResponse($name, $position, ...$outputComponents);
        }
        return $globalResponse;
    }

    public static function enableHtmlStructure(): void {
        $globalResponses = [
            self::createOrUpdateGlobalResponse(
                'OpeningHtml',
                -2147483648,
                self::createOrUpdateOutputComponent('Doctype', 'CoreOutput', -2147483648, PHP_EOL .  '<!DOCTYPE html>' . PHP_EOL),
                self::createOrUpdateOutputComponent('OpenHtml', 'CoreOutput', -2147483647.99, PHP_EOL . '<html lang="en">' . PHP_EOL),
                self::createOrUpdateOutputComponent('OpenHead', 'CoreOutput', -2147483646.98, PHP_EOL . '    <head>' . PHP_EOL),
            ),
            self::createOrUpdateGlobalResponse(
                'ClosingHeadOpenBody',
                -1,
                self::createOrUpdateOutputComponent('CloseHead', 'CoreOutput', 2147483646.99, PHP_EOL . '    </head>' . PHP_EOL),
                self::createOrUpdateOutputComponent('OpenBody', 'CoreOutput', 2147483647, PHP_EOL . '    <body>' . PHP_EOL),
            ),
            self::createOrUpdateGlobalResponse(
                'ClosingHtml',
                2147483647,
                self::createOrUpdateOutputComponent('CloseBody', 'CoreOutput', 2147483646.99, PHP_EOL . PHP_EOL . '    </body>'),
                self::createOrUpdateOutputComponent('CloseHtml', 'CoreOutput', 2147483647, PHP_EOL . PHP_EOL . '</html>'),
            ),

        ];
    }
}

HtmlStructure::enableHtmlStructure();


##################################################################################################





$currentRequest = new Request(new Storable('CurrentRequest', 'Requests', 'Index'), new Switchable());
$appComonentsFactory = AppBuilder::getAppsAppComponentsFactory(strval(basename(__DIR__)), $currentRequest->getUrl());

try {
    $userInterface = new ResponseUI(
        $appComonentsFactory->getPrimaryFactory()->buildStorable('AppUI', 'Index'),
        $appComonentsFactory->getPrimaryFactory()->buildSwitchable(),
        $appComonentsFactory->getPrimaryFactory()->buildPositionable(0),
        new Router(
            $appComonentsFactory->getPrimaryFactory()->buildStorable('AppRouter', 'Index'),
            $appComonentsFactory->getPrimaryFactory()->buildSwitchable(),
            $currentRequest,
            $appComonentsFactory->getComponentCrud()
        )
    );
    echo $userInterface->getOutput();
} catch (RuntimeException $runtimeException) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Your request could not be processed.</title>
        <style>
            body {
                background: #0a0800;
                color: #a68159;
            }

            .error {
                color: #732b3f;
            }
        </style>
    </head>
    <body>
    <h1>404 Not Found</h1>
    <p>Sorry, the you request you made is not valid. Please try again later.</p>
    <ul>
        <li>App Name: <?php echo $appComonentsFactory->getApp()->getName(); ?></li>
        <li>Request: <?php echo $currentRequest->getUrl(); ?></li>
        <li class="error">Error Message: <?php echo $runtimeException->getMessage(); ?></li>
    </ul>
    </body>
    </html>
    <?php
}
?>
<!-- Powered by the Darling Cms | Currently Running App: <?php echo App::deriveNameLocationFromRequest($currentRequest); ?> -->
