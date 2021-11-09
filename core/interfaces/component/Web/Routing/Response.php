<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\component\OutputComponent; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 
use roady\interfaces\primary\Positionable; 

/**
 * A Response is a SwitchableComponent that represents a
 * response to a request to a domain.
 * 
 * A Response can be used to associate stored OutputComponents 
 * with stored Requests.
 *
 * A Response will respond to any request to a domain that
 * is represented by a Request whose url matches the url
 * of one of the stored Requests that are assigned to the 
 * Response.
 *
 * A Response will also respond to any request to a domain that
 * defines a $_GET parameter named `request` whose assigned
 * value matches the name of this Response.
 *
 * Constants:
 * 
 * RESPONSE_CONTAINER: string
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
 * public function respondsToRequest(Request $request, ComponentCrud $crud): bool;
 * public function addRequestStorageInfo(Request $request): bool;
 * public function getRequestStorageInfo(): array<int, Storable>;
 * public function removeRequestStorageInfo(string $nameOrId): bool;
 * public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;
 * public function removeOutputComponentStorageInfo(string $nameOrId): bool;
 * public function getOutputComponentStorageInfo(): array<int, Storable>;
 *
 */
interface Response extends SwitchableComponent, Positionable
{

    /**
     * @var string RESPONSE_CONTAINER The alpha-numeric name of 
     *                                the container assigned to 
     *                                all implementations of the 
     *                                Response interface. 
     */
    public const RESPONSE_CONTAINER = "RESPONSES";

    /**
     * Return the value assigned to the RESPONSE_CONTAINER constant. 
     *
     * Note: All implementations of the Response interface must 
     * return the value of the RESPONSE_CONTAINER constant from 
     * their respective implementations of the getContainer() 
     * method. This insures the name of the container Responses 
     * are stored in is always predictable regardless of the 
     * location they are stored at.
     *
     * @return string The value assigned to the RESPONSE_CONTAINER
     *                constant.
     */
    public function getContainer(): string;

    /**
     * Determine whether it is appropriate for this Response
     * to respond to the specified Request.
     *
     * Returns true if this Response is assigned a stored Request 
     * whose url matches the specified Request's url, or if the 
     * specified Request defines a $_GET parameter named 'request' 
     * whose assigned value matches the name of this Response, false 
     * otherwise.
     *
     * @param Request $request The Request to check.
     *
     * @param ComponentCrud $crud A ComponentCrud to use to read 
     *                            assigned stored Requests from 
     *                            storage.
     * 
     * @return bool True if this Response is assigned a stored 
     *              Request whose url matches the specified 
     *              Request's url, or if the specified Request 
     *              defines a $_GET parameter named 'request' 
     *              whose assigned value matches the name of the 
     *              Response, false otherwise.
     *
     */
    public function respondsToRequest(Request $request, ComponentCrud $crud): bool;

    /**
     * Assign a Request to this Response by adding it's Storable
     * to this Response's assigned Request Storables.
     *
     * @param Request $request The Request to add.
     *
     * @return bool True if the Request's Storable was added to 
     *              this Response's assigned Request Storables, 
     *              false otherwise.
     */
    public function addRequestStorageInfo(Request $request): bool;

    /**
     * Return a numerically indexed array of the Request Storables 
     * assigned to this Response.
     *
     * Note: These Storables can be used to read the actual Requests 
     *       from storage via a ComponentCrud.
     *
     * @return array<int, Storable> A numerically indexed array of 
     *                              the Request Storables assigned 
     *                              to this Response.
     */
    public function getRequestStorageInfo(): array;

    /**
     * Remove an assigned Request's Storable by name or unique id
     * from the Request Storables assigned to this Response.
     *
     * Note: It is up to the implementation to determine how
     * to resolve a specified name that matches the name of
     * multiple assigned Requests.
     *
     * @param string $nameOrId The name, or unique id of the Request
     *                         to remove.
     *
     * @return bool True if the Request's Storable was removed from
     *              the Request Storables assigned to this Response,
     *              false otherwise.
     * 
     * @see https://github.com/sevidmusic/Roady/issues/268
     *
     */
    public function removeRequestStorageInfo(string $nameOrId): bool;

    /**
     * Assign a OutputComponent to this Response by adding it's 
     * Storable to this Response's assigned OutputComponent 
     * Storables.
     *
     * @param OutputComponent $outputComponent The OutputComponent 
     *                                         to add.
     *
     * @return bool True if the OutputComponent's Storable was added 
     *              to this Response's assigned OutputComponent 
     *              Storables, false otherwise.
     */
    public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;

    /**
     * Remove an assigned OutputComponent's Storable by name or 
     * unique id from the OutputComponent Storables assigned to 
     * this Response.
     *
     * Note: It is up to the implementation to determine how
     * to resolve a specified name that matches the name of
     * multiple assigned OutputComponents.
     *
     * @param string $nameOrId The name, or unique id of the 
     *                         OutputComponent to remove.
     *
     * @return bool True if the OutputComponent's Storable was 
     *              removed from the OutputComponent Storables 
     *              assigned to this Response, false otherwise.
     */
    public function removeOutputComponentStorageInfo(string $nameOrId): bool;

    /**
     * Return a numerically indexed array of the OutputComponent 
     * Storables assigned to this Response.
     *
     * Note: These Storables can be used to read the actual 
     *       OutputComponents from storage via a ComponentCrud.
     *
     * @return array<int, Storable> A numerically indexed array of 
     *                              the OutputComponent Storables 
     *                              assigned to this Response.
     *
     * @see https://github.com/sevidmusic/Roady/issues/268
     *
     */
    public function getOutputComponentStorageInfo(): array;

}
