<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Web\Routing\Response as CoreResponse;

/**
 * A GlobalResponse is a Response that will respond to all
 * requests to a domain.
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
interface GlobalResponse extends CoreResponse
{

}
