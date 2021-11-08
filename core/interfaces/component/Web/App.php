<?php

namespace roady\interfaces\component\Web;

use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\component\SwitchableComponent;
use roady\interfaces\component\Web\Routing\Request;

/**
 * An App is a SwitchableComponent that represents a roady App
 * that has been built for a domain.
 * 
 * Constants:
 *
 * APP_CONTAINER: string 
 *
 * Methods:
 *
 * public function getState(): bool;
 * public function switchState(): bool;
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array<string, mixed> $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public static function deriveAppLocationFromRequest(Request $request): string;
 * public function getAppDomain(): Request;
 *
 */
interface App extends SwitchableComponent
{

    /**
     * @var string APP_CONTAINER The name of the container assigned
     *                           to all implementations of the App
     *                           interface. 
     */
    public const APP_CONTAINER = "APP";

    /**
     * Return the value assigned to the APP_CONTAINER constant.
     * All implementations of the App interface must return
     * the value of the APP_CONTAINER constant from their 
     * respective implementation of the getContainer() method
     * so that the name of the container Apps are stored in
     * is always predictable regardless of the location Apps
     * are stored at.
     *
     * @return string The value assigned to the APP_CONTAINER 
     *                constant.
     */
    public function getContainer(): string;

    /**
     * Determine the name expected to be assigned as an App's 
     * location based on a specified Request. 
     *
     * @param Request $request The Request to use to determine 
     *                         the name expected to be assigned 
     *                         as an App's location. 
     *
     * @return string The name expected to be assigned as an App's 
     *                location based on a specified Request. 
     */
    public static function deriveAppLocationFromRequest(Request $request): string;

    /**
     * Return a Request that represents the domain the App 
     * was built for.
     *
     * @return Request A Request that represents the domain the 
     *                 App was built for.
     */
    public function getAppDomain(): Request;

}
