<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\component\OutputComponent; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 
use roady\interfaces\primary\Positionable; 

/**
 * A Response is a SwitchableComponent that represents a
 * response to a request to a domain, and can be used to 
 * associate stored OutputComponents with stored Requests.
 *
 * A Response may respond to requests to a domain that are 
 * represented by a Request that matches one of the stored 
 * Requests assigned to the Response.
 *
 * A Response may also respond to requests to a domain that 
 * defines a $_GET parameter named `request` whose assigned
 * value matches the name of the Response.
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
 * public function import(array $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public function respondsToRequest(Request $request, ComponentCrud $crud): bool;
 * public function addRequestStorageInfo(Request $request): bool;
 * public function getRequestStorageInfo(): array;
 * public function removeRequestStorageInfo(string $nameOrId): bool;
 * public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;
 * public function removeOutputComponentStorageInfo(string $nameOrId): bool;
 * public function getOutputComponentStorageInfo(): array;
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
     * Returns true if this Response is assigned a stored Request 
     * that matches the specified $request, false otherwise.
     *
     * Note: The Request must match a Request that exists in
     * storage that is accessible to the specified ComponentCrud.
     *
     * @param Request $request The Request to check.
     *
     * @param ComponentCrud $crud A ComponentCrud to use to read 
     *                            stored Requests from storage.
     *                      
     *
     * @return bool True if this Response is assigned a stored 
     *              Request that matches the specified $request, 
     *              false otherwise.
     *
     */
    public function respondsToRequest(Request $request, ComponentCrud $crud): bool;

    /**
     * Add the specified Request's Storable to this Response's
     * assigned Request Storables. 
     * 
     */
    public function addRequestStorageInfo(Request $request): bool;

    /**
     * @return array<int, Storable>
     */
    public function getRequestStorageInfo(): array;

    public function removeRequestStorageInfo(string $nameOrId): bool;

    public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;

    public function removeOutputComponentStorageInfo(string $nameOrId): bool;

    /**
     * @return array<int, Storable>
     */
    public function getOutputComponentStorageInfo(): array;

}
