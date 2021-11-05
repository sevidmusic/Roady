<?php

namespace roady\interfaces\component;

use roady\interfaces\component\Component;
use roady\interfaces\primary\Switchable;

/**
 * A SwitchableComponent is a Component that has a switchable 
 * boolean state.
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
 *
 */
interface SwitchableComponent extends Switchable, Component
{

}
