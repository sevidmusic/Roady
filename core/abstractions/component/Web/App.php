<?php

namespace DarlingDataManagementSystem\abstractions\component\Web;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App as AppInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException as PHPRuntimeException;

abstract class App extends SwitchableComponentBase implements AppInterface
{
    public const APP_CONTAINER = "APP";
    private ?RequestInterface $domain = null;

    public function __construct(RequestInterface $request, SwitchableInterface $switchable)
    {
        $storable = new CoreStorable(
            self::deriveNameLocationFromRequest($request),
            self::deriveNameLocationFromRequest($request),
            self::APP_CONTAINER
        );
        parent::__construct($storable, $switchable);
        $this->domain = $request;
    }

    public static function deriveNameLocationFromRequest(RequestInterface $request): string
    {
        $nameLocation = preg_replace(
                            "/[^A-Za-z0-9]/",
                            '',
                            parse_url($request->getUrl(), PHP_URL_HOST) . strval(parse_url($request->getUrl(), PHP_URL_PORT))
                        );
        return (empty($nameLocation) === true ? 'DEFAULT' : $nameLocation);
    }

    public static function getRequestedApp(RequestInterface $request, ComponentCrudInterface $componentCrud): AppInterface
    {
        $installedApps = $componentCrud->readAll(
            App::deriveNameLocationFromRequest($request),
            App::APP_CONTAINER
        );
        if (empty($installedApps)) {
            throw new PHPRuntimeException('The requested app has not been installed, in fact, no apps have been installed. Please install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
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
            throw new PHPRuntimeException('The requested app has not been installed. Please install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
        }
        $app = (empty($app) ? new \DarlingDataManagementSystem\classes\component\Web\App($request, new \DarlingDataManagementSystem\classes\primary\Switchable()) : $app);
        if (self::isAnApp($app) === false) {
            throw new PHPRuntimeException('The requested App is corrupted. Please remove and re-install the "' . App::deriveNameLocationFromRequest($request) . '" app.');
        }
        if ($app->getState() === false) {
            throw new PHPRuntimeException('The requested app ' . $app->getName() . ' is not available at this time');
        }
        return $app;
    }

    private static function isAnApp(ComponentInterface $component): bool
    {
        return (
        in_array('DarlingDataManagementSystem\interfaces\component\Web\App', class_implements($component))
            ? true
            : false
        );
    }

    public function getAppDomain(): RequestInterface
    {
        return $this->domain;
    }

}
