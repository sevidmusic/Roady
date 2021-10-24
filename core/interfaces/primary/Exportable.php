<?php

namespace roady\interfaces\primary;

/**
 * This interface defines an object whose properties can be exported,
 * or set by importing properties exported from another Exportable
 * object of the same type.
 */
interface Exportable extends Classifiable
{

    /**
     * @return array<mixed> An array of the object's property values.
     * This array can be passed to the import() method of another
     * Exportable object of the same type.
     */
    public function export(): array;

    /**
     * @param array<mixed> $export An array of property values to
     * import whose structure matches the structure of an array
     * returned by the export() method of an Exportable object
     * of the same type.
     */
    public function import(array $export): bool;

}
