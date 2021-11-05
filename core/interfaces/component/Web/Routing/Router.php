<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\component\Web\Routing\Response; 

/**
 * A Router is a SwitchableComponent that can be used to obtain the 
 * stored Responses that should be served in response to a specific
 * Request.
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
 * public function getCrud(): ComponentCrud;
 * public function getRequest(): Request;
 * public function getResponseContainer(): string;
 * public function getResponses(string $location, string $container): array;
 *
 */ 
interface Router extends SwitchableComponent
{

    /**
     * Return the ComponentCrud used to read Responses from storage.
     *
     * @return ComponentCrud The ComponentCrud used to read Responses
     * `                     from storage.
     */
    public function getCrud(): ComponentCrud;

    /**
     * Return the Request this Router serves Responses in 
     * response to.
     *
     * @return Request The Request this Router serves Responses in
     *                 response to.
     */
    public function getRequest(): Request;

    /**
     * Return the name of the container the Responses are expected
     * to be stored in.
     *
     * @return string The name of the container the Responses are 
     *                expected to be stored in.
     */
    public function getResponseContainer(): string;

    /**
     * Return a numerically indexed array of Responses that 
     * should be served in response to the Request returned 
     * by this Router's getRequest() method.
     *
     * @return array<int, Response> A numerically indexed array 
     *                              of Responses that should be 
     *                              served in response to the 
     *                              Request returned by this 
     *                              Router's getRequest() method.
     */
    public function getResponses(string $location, string $container): array;

}
