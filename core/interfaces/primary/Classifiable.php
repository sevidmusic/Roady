<?php

namespace roady\interfaces\primary;

/**
 * This interface defines an object that can articulate it's
 * own type in a manner equal to calling `get_class($this)`.
 */
interface Classifiable
{

    /**
     * @return string The objects type. This must be equal to
     * calling `get_class($this)`, and may or may not be equal
     * to calling `Object::class`.
     *
     * Note: For a good explanation of the difference between
     * `get_class()` and `::class`:
     * @see https://stackoverflow.com/questions/34118725/difference-between-class-and-get-class
     */
    public function getType(): string;

}
