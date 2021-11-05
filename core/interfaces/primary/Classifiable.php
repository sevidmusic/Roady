<?php

namespace roady\interfaces\primary;

/**
 * A Classifiable can articulate its own type in a manner equal
 * to calling `get_class($this);`.
 *
 * Methods:
 *
 * public function getType(): string;
 *
 */
interface Classifiable
{

    /**
     * Returns the objects type.
     *
     * Note: The return value will match the value returned by 
     * calling `get_class($this);`, but will not necessarily match 
     * the value of `CLASSNAME::class;`. 
     *
     * @return string The objects type. 
     *
     * @see https://www.php.net/manual/en/function.get-class.php
     * @see https://stackoverflow.com/questions/34118725/difference-between-class-and-get-class
     */
    public function getType(): string;

}
