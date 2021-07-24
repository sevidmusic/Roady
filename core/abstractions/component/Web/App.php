<?php

namespace roady\abstractions\component\Web;

use roady\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException as PHPRuntimeException;

abstract class App extends SwitchableComponentBase implements AppInterface
{
    private RequestInterface $domain;

    public function __construct(RequestInterface $request, SwitchableInterface $switchable, string $appName = '')
    {
        $this->domain = $request;
        if(!empty($appName)) {
            $actualName = preg_replace("/[^A-Za-z0-9]/", '', $appName);
        }
        $storable = new CoreStorable(
            ($actualName ?? self::deriveAppLocationFromRequest($request)),
            self::deriveAppLocationFromRequest($request),
            self::APP_CONTAINER
        );
        parent::__construct($storable, $switchable);
    }

    public static function deriveAppLocationFromRequest(RequestInterface $request): string
    {
        $nameLocation = preg_replace(
            "/[^A-Za-z0-9]/",
            '',
            parse_url($request->getUrl(), PHP_URL_HOST) . strval(parse_url($request->getUrl(), PHP_URL_PORT))
        );
        return (empty($nameLocation) === true ? 'DEFAULT' : $nameLocation);
    }

    private static function isAnApp(ComponentInterface $component): bool
    {
        $classImplements = class_implements($component);
        return (
            in_array(
                AppInterface::class,
                (is_array($classImplements) ? $classImplements : [])
            )
            ? true
            : false
        );
    }

    public function getAppDomain(): RequestInterface
    {
        return $this->domain;
    }

}
