<?php

namespace roady\interfaces\constituents;

use roady\interfaces\strings\ClassString;
use roady\interfaces\strings\Id;
use roady\interfaces\strings\Name;

/**
 * An Identifiable can be identified by name, id, and type.
 *
 * @example
 *
 * ```
 * echo $identifiable->name();
 * // example output: Name
 *
 * echo $identifiable->id();
 * // example output:
 * KNrZfZnDxNd3s7WB43nxPBM74CkPzW2TFJpX2FtTYAOT30ssNjCup6OolKDL
 *
 * echo $identifiable->type();
 * // example output: roady\classes\constituents\Identifiable
 *
 * ```
 */
interface Identifiable
{

    /**
     * Return the assigned Name.
     *
     * @return Name
     *
     * @example
     *
     * ```
     * echo $identifiable->name();
     * // example output: Name
     *
     * ```
     *
     */
    public function name(): Name;

    /**
     * Return the assigned Id.
     *
     * @return Id
     *
     * @example
     *
     * ```
     * echo $identifiable->id();
     * // example output:
     * ScRZfn3s397WBb43BQ74bCkP2zWfq2jnTkFfhJp5X2Ft30ssNjCup6OolKDL
     *
     * ```
     *
     */
    public function id(): Id;

    /**
     * Return the Identifiable implementation's type as a ClassString.
     *
     * @return ClassString
     *
     * @example
     *
     * ```
     * echo $identifiable->type();
     * // example output: roady\classes\constituents\Identifiable
     *
     * ```
     *
     */
    public function type(): ClassString;

}

