<?php

namespace DarlingDataManagementSystem\classes\utility;

use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
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
use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse;

class HtmlStructure {

    private const DARLING_DATA_MANAMENT_SYSTEM = 'HtmlStructure';
    private static function getCurrentRequest(): RequestInterface {
        return new Request(new Storable('CurrentRequest', 'Requests', self::DARLING_DATA_MANAMENT_SYSTEM), new Switchable());
    }

    private static function getAppComponentsFactory(): AppComponentsFactoryInterface {
        return AppBuilder::getAppsAppComponentsFactory(self::DARLING_DATA_MANAMENT_SYSTEM, self::getCurrentRequest()->getUrl());
    }

    private static function getComponentCrud(): ComponentCrudInterface {
        return self::getAppComponentsFactory()->getComponentCrud();
    }

    private static function getPrimaryFactory(): PrimaryFactoryInterface {
        return self::getAppComponentsFactory()->getPrimaryFactory();
    }

    private static function createOrUpdateOutputComponent(string $name, string $container, float $position, string $output): OutputComponentInterface {
        try {
            # OC exists, read from storage, and update position and output to match specified
            /**
             * @var OutputComponent $outputComponent
             */
            $outputComponent = self::getComponentCrud()->readByNameAndType($name, OutputComponent::class, self::getAppComponentsFactory()->getLocation(), $container);
        } catch (\RuntimeException $e) {
            # OC does not exist, create and store it
            $outputComponent = self::getAppComponentsFactory()->buildOutputComponent($name, $container, $output, $position);
        }
        return $outputComponent;
    }

    private static function createOrUpdateGlobalResponse(string $name, float $position, OutputComponentInterface ...$outputComponents): void {
        try {
            # OC exists, read from storage, and update position and output to match specified
            /**
             * @var GlobalResponseInterface $globalResponse
             */
            $globalResponse = self::getComponentCrud()->readByNameAndType($name, GlobalResponse::class, self::getAppComponentsFactory()->getLocation(), GlobalResponse::RESPONSE_CONTAINER);
        } catch (\RuntimeException $e) {
            # OC does not exist, create and store it
            $globalResponse = self::getAppComponentsFactory()->buildGlobalResponse($name, $position, ...$outputComponents);
        }
    }

    public static function enableHtmlStructure(): void {
        self::createOrUpdateGlobalResponse(
            'OpeningHtml',
            -2147483648,
            self::createOrUpdateOutputComponent('Doctype', 'CoreOutput', -2147483648, PHP_EOL .  '<!DOCTYPE html>' . PHP_EOL),
            self::createOrUpdateOutputComponent('OpenHtml', 'CoreOutput', -2147483647.99, PHP_EOL . '<html lang="en">' . PHP_EOL),
            self::createOrUpdateOutputComponent('OpenHead', 'CoreOutput', -2147483646.98, PHP_EOL . '    <head>' . PHP_EOL),
        );
        self::createOrUpdateGlobalResponse(
            'ClosingHeadOpenBody',
            -1,
            self::createOrUpdateOutputComponent('CloseHead', 'CoreOutput', 2147483646.99, PHP_EOL . '    </head>' . PHP_EOL),
            self::createOrUpdateOutputComponent('OpenBody', 'CoreOutput', 2147483647, PHP_EOL . '    <body>' . PHP_EOL),
        );
        self::createOrUpdateGlobalResponse(
            'ClosingHtml',
            2147483647,
            self::createOrUpdateOutputComponent('CloseBody', 'CoreOutput', 2147483646.99, PHP_EOL . PHP_EOL . '    </body>'),
            self::createOrUpdateOutputComponent('CloseHtml', 'CoreOutput', 2147483647, PHP_EOL . PHP_EOL . '</html>'),
        );
    }
}
