<?php

namespace roady\interfaces\component\UserInterface;

use roady\interfaces\component\OutputComponent; 
use roady\interfaces\component\Web\Routing\Router; 

/**
 * A ResponseUI is an OutputComponent whose output is generated
 * from the collective output of all of the OutputComponents that
 * are assigned to each of the Responses returned by a Router
 * in response to a specific Request.
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
 * public function getOutput(): string;
 * public function increasePosition(): bool;
 * public function decreasePosition(): bool;
 * public function getPosition(): float;
 * public function getRouter(): Router;
 *
 */
interface ResponseUI extends OutputComponent
{

    public function getRouter(): Router;
}
