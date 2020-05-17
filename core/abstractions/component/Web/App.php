<?php

namespace DarlingCms\abstractions\component\Web;

use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Web\App as AppInterface;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\primary\Switchable;
use RuntimeException;

abstract class App extends CoreSwitchableComponent implements AppInterface
{
    public const APP_CONTAINER = "APP";

    public function __construct(Request $request, Switchable $switchable)
    {
        $storable = new CoreStorable(
            self::deriveNameLocationFromRequest($request),
            self::deriveNameLocationFromRequest($request),
            self::APP_CONTAINER
        );
        parent::__construct($storable, $switchable);
    }

    public static function deriveNameLocationFromRequest(Request $request): string
    {
        $nameLocation = preg_replace("/[^A-Za-z0-9]/", '', parse_url($request->getUrl(), PHP_URL_HOST));
        return (empty($nameLocation) === true ? 'DEFAULT' : $nameLocation);
    }

    public static function getRequestedApp(Request $request, ComponentCrud $componentCrud): AppInterface
    {
        $installedApps = $componentCrud->readAll(
            App::deriveNameLocationFromRequest($request),
            App::APP_CONTAINER
        );
        if (empty($installedApps)) {
            throw new RuntimeException('The requested app has not been installed, in fact, no apps have been installed. Please install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
        }
        foreach ($installedApps as $storedApp) {
            if (
                $storedApp->getName() === self::deriveNameLocationFromRequest($request) &&
                $storedApp->getLocation() === self::deriveNameLocationFromRequest($request) &&
                $storedApp->getContainer() === self::APP_CONTAINER
            ) {
                $app = $storedApp;
                break;
            }
            throw new RuntimeException('The requested app has not been installed. Please install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
        }
        $app = (empty($app) ? new \DarlingCms\classes\component\Web\App($request, new \DarlingCms\classes\primary\Switchable()) : $app);
        if (self::isAnApp($app) === false) {
            throw new RuntimeException('The requested App is corrupted. Please remove and re-install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
        }
        if ($app->getState() === false) {
            throw new RuntimeException('The requested app ' . $app->getName() . ' is not available at this time');
        }
        return $app;
    }

    private static function isAnApp(Component $component): bool
    {
        return (
        in_array('DarlingCms\interfaces\component\Web\App', class_implements($component))
            ? true
            : false
        );
    }
}
