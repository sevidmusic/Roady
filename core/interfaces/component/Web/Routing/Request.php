<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

/**
 * A Request is a SwitchableComponent that represents a specific 
 * request to a domain.
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
 * public function getGet(): array;
 * public function getPost(): array;
 * public function getUrl(): string;
 *
 */
interface Request extends SwitchableComponentInterface
{

    /**
     * Return the $_GET array for this Request. 
     *
     * @return array<mixed> Return the $_GET array for this Request. 
     */
    public function getGet(): array;

    /**
     * Return the $_POST array for this Request. 
     *
     * @return array<mixed> The $_POST array for this Request. 
     */
    public function getPost(): array;

    /**
     * Return the url associated with this Request.
     *
     * @return string The url associated with this Request.
     */
    public function getUrl(): string;

}
