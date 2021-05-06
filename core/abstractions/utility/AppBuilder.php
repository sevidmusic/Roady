<?php

namespace DarlingDataManagementSystem\abstractions\utility;

use DarlingDataManagementSystem\interfaces\utility\AppBuilder as AppBuilderInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\classes\component\Factory\App\AppComponentsFactory;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use \Exception;

abstract class AppBuilder implements AppBuilderInterface
{

    public static function getAppsAppComponentsFactory(string $appName, string $domain): AppComponentsFactoryInterface
    {
        $domainRequest = self::buildAppDomain($domain);
        $appComponentsFactory = self::newAppComponentsFactory($appName, $domainRequest);
        try {
            /**
             * @var AppComponentsFactoryInterface $appComponentsFactory
             */
            $appComponentsFactory = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                $appComponentsFactory->getName(),
                $appComponentsFactory->getType(),
                CoreApp::deriveNameLocationFromRequest($domainRequest),
                AppComponentsFactory::CONTAINER
            );
        } catch(Exception $e) {
            $appComponentsFactory->getComponentCrud()->create($appComponentsFactory);
        }
        return $appComponentsFactory;
    }

    public static function buildApp(AppComponentsFactoryInterface $appComponentsFactory): void
    {
    }

    /**
     * Return a new instance of an AppComponentsFactory for an App.
     * @param string $appName The name of the App to create a new AppComponentsFactory instance for.
     * @param RequestInterface $domain  The App's domain.
     * @return AppComponentsFactoryInterface A new AppComponentsFactory instance.
     */
    private static function newAppComponentsFactory(string $appName, RequestInterface $domain): AppComponentsFactoryInterface
    {
        return new AppComponentsFactory(
            ...AppComponentsFactory::buildConstructorArgs(
                $domain,
                new CoreApp($domain, new CoreSwitchable(), $appName)
            )
        );
    }

    /**
     * Return an appropritate Request to be used as the App's domain.
     * If $domain is a valid url, it will be used, if it
     * is not a valid url, http://localhost:8080 will be used.
     * @param string $domain The App's domain.
     * @return RequestInterface A Request instance that represents the App's domain.
     */
    private static function buildAppDomain(string $domain): RequestInterface
    {
        $domain = str_replace(["'"], [''], $domain);
        if(filter_var($domain, FILTER_VALIDATE_URL)) {
            $useDomain = $domain;
        }
        return AppComponentsFactory::buildDomain(($useDomain ?? 'http://localhost:8080'));
    }

}
