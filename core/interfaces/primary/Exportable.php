<?php

namespace roady\interfaces\primary;

/**
 * An Exportable can articulate its own type in a manner equal
 * to calling `get_class($this)`, can export its properties as 
 * an array of values that are indexed by property name, and can 
 * have its properties set by importing an array of values that 
 * are indexed by property name. 
 * 
 * Methods:
 *
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array $export): bool;
 */
interface Exportable extends Classifiable
{

    /**
     * Returns an array of the object's property values indexed by
     * property name.
     *
     * Note: This array can be passed to the import() method of 
     * another Exportable object of the same type.
     *
     * @return array<string, mixed> An array of the object's property 
     *                              values indexed by property name.
     */
    public function export(): array;

    /**
     * Set one or more property values using an array of values
     * that are indexed by the name of the property the value is
     * to be assigned to.
     *
     * For example, if an Exportable object named Foo defined a 
     * property named $bar whose type was string, then $bar could
     * be set via:
     *
     * `$foo->import(['bar' => "bar's new value"]);`
     *
     * Note: The type of each property value must match the type
     * expected by the property being set. For example, a property
     * that expects a string cannot be assigned a boolean.
     *
     * Note: It is not necessary to provide values for all 
     * property's, only those that are intended to be set.
     *
     * Note: This method can be used to set properties of any scope.
     *
     * @param array<string, mixed> $export An array of property 
     *                                     values to import indexed 
     *                                     by property name.
     *
     * @return bool True if import was successful, false otherwise.
     */
    public function import(array $export): bool;

}
