<?php

namespace DarlingDataManagementSystem\abstractions\utility;

use DarlingDataManagementSystem\interfaces\utility\AppBuilder as AppBuilderInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;

abstract class AppBuilder implements AppBuilderInterface
{

    /**
     * Either create, store, and return a new AppComponentsFactory instance for
     * the App, or return the App's existing AppComponentsFactory from storage.
     * This AppComponentsFactory instance can be used to build Components for
     * the App for the specified domain.
     *
     * @param string $appName The name of the App to return a AppComponentsFactory
     *                        instance for.
     *
     * @param string $domain The domain the AppComponentsFactory will build the
     *                       App's Components for. For example: http://localhost:8080
     *
     * @return AppComponentsFactoryInterface The App's AppComponentsFactory.
     */
    abstract public static function getAppsAppComponentsFactory(string $appName, string $domain): AppComponentsFactoryInterface;

    /**
     * Build the App assigned to the provided AppComponentsFactory instance.
     *
     * @param AppComponentsFactoryInterface $appComponentsFactory The AppComponentsFactory instance
     *                                                            to use to build the App's configured
     *                                                            Components.
     *
     */
    abstract public static function buildApp(AppComponentsFactoryInterface $appComponentsFactory): void;

}
