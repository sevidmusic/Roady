<?php

namespace roady\interfaces\component;

use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Positionable; 

/**
 * An OutputComponent is a SwitchableComponent that can generate 
 * output, and has a numeric position that can be incremented or 
 * decremented.
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
 * public function getOutput(): string;
 * public function increasePosition(): bool;
 * public function decreasePosition(): bool;
 * public function getPosition(): float;
 *
 */
interface OutputComponent extends SwitchableComponent, Positionable
{

    /**
     * Returns the output of this OutputComponent.
     *
     * @return string The output of this OutputComponent.
     */
    public function getOutput(): string;

}
