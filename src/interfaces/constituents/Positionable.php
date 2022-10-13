<?php

namespace roady\interfaces\constituents;

/**
 * A Positionable has a numeric position that can be incremented or
 * decremented by a modifier.
 *
 * @example
 *
 * ```
 * echo strval($positionable->modifier();
 * // example output: 0.99
 *
 * echo strval($positionable->position());
 * // example output: 9.17
 *
 * $positionable->decrementPosition();
 *
 * echo strval($positionable->position());
 * // example output: 8.18
 *
 * $positionable->incrementPosition();
 *
 * echo strval($positionable->position());
 * // example output: 9.17
 *
 * ```
 *
 */
interface Positionable
{

    /**
     * Decrement the position by the modifier.
     *
     * @return void
     *
     * @example
     *
     * ```
     * echo strval($positionable->modifier();
     * // example output: 1
     *
     * echo strval($positionable->position());
     * // example output: 0
     *
     * $positionable->decrementPosition();
     *
     * echo strval($positionable->position());
     * // example output: -1
     *
     * ```
     *
     */
    public function decrementPosition(): void;

    /**
     * Increment the position by the modifier.
     *
     * @return void
     *
     * @example
     *
     * ```
     * echo strval($positionable->modifier();
     * // example output: 0.01
     *
     * echo strval($positionable->position());
     * // example output: -0.09
     *
     * $positionable->incrementPosition();
     *
     * echo strval($positionable->position());
     * // example output: -0.08
     *
     * ```
     *
     */
    public function incrementPosition(): void;

    /**
     * Return the modifier.
     *
     * @return float
     *
     * @example
     *
     * ```
     * echo strval($positionable->modifier();
     * // example output: 0.01
     *
     * ```
     *
     */
    public function modifier(): float;

    /**
     * Return the current position.
     *
     * @return float
     *
     * @example
     *
     * ```
     * echo strval($positionable->position();
     * // example output: 5.02
     *
     * ```
     *
     */
    public function position(): float;

}

