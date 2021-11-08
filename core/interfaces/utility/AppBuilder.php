<?php

namespace roady\interfaces\utility;

use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;

/**
 * An AppBuilder is a utility that can be used to build a roady
 * App and it's configured Components for a domain.
 */
interface AppBuilder {

    /**
     * Either create, store, and return a new AppComponentsFactory 
     * instance for the App, or return the App's existing 
     * AppComponentsFactory from storage. This AppComponentsFactory 
     * instance can be used to build Components for the App for the 
     * specified domain.
     *
     * @param string $appName The name of the App to return a AppComponentsFactory
     *                        instance for.
     *
     * @param string $domain The domain the AppComponentsFactory will build the
     *                       App's Components for. For example: http://localhost:8080
     *
     * @return AppComponentsFactoryInterface The App's AppComponentsFactory.
     */
    public static function getAppsAppComponentsFactory(string $appName, string $domain): AppComponentsFactoryInterface;

    /**
     * Build the App assigned to the provided AppComponentsFactory instance.
     *
     * @param AppComponentsFactoryInterface $appComponentsFactory The AppComponentsFactory instance
     *                                                            to use to build the App's configured
     *                                                            Components.
     *
     */
    public static function buildApp(AppComponentsFactoryInterface $appComponentsFactory): void;

}
