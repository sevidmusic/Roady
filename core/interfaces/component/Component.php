<?php

namespace roady\interfaces\component;

use roady\interfaces\primary\Classifiable;
use roady\interfaces\primary\Exportable;
use roady\interfaces\primary\Identifiable;
use roady\interfaces\primary\Storable;

/**
 * A Component can articulate its own type in a manner equal to 
 * calling `get_class($this);`, can export its properties as an 
 * array of values that are indexed by property name, can have its 
 * properties set by importing an array of values that are indexed 
 * by property name, can be identified by an alpha-numeric name, 
 * can be identified by a unique alpha-numeric id, and can be 
 * stored in a specific container at a specific location.
 *
 * Methods:
 *
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array<string, mixed> $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 *
 */
interface Component extends Classifiable, Exportable, Identifiable, Storable
{

}
