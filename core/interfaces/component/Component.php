<?php

namespace roady\interfaces\component;

use roady\interfaces\primary\Classifiable;
use roady\interfaces\primary\Exportable;
use roady\interfaces\primary\Identifiable;
use roady\interfaces\primary\Storable;

/**
 * A Component has an alpha-numeric name, a unique alpha-numeric id,
 * can articulate its own type, can be stored in a specific container
 * at a specific location, can export its properties as an array of
 * values that are indexed by property name, and can have its
 * properties set by importing an array of values that are indexed
 * by property name.
 *
 * Methods:
 *
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 */
interface Component extends Classifiable, Exportable, Identifiable, Storable
{

}
