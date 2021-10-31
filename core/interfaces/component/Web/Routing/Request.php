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
     * @return array<mixed>
     */
    public function getGet(): array;

    /**
     * @return array<mixed>
     */
    public function getPost(): array;

    /**
     * @return string
     */
    public function getUrl(): string;

}
