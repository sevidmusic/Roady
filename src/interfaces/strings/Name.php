<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\SafeText;

/**
 * A Name is SafeText that begins with an alphanumeric character,
 * and is no more than 70 characters in length.
 *
 * @see SafeText
 *
 */
interface Name extends SafeText
{

    /**
     * At the moment the Name interface does not define any
     * unique methods.
     *
     * This may change in the future.
     *
     * For now, this interface just functions as a namespace.
     *
     */

}
