<?php

namespace roady\interfaces\constituents;

/**
 * A Switchable has a switchable boolean state.
 *
 * @example
 *
 * ```
 * echo ($switchable->state() ? 'true' : 'false');
 * // example output: true
 *
 * $switchable->switchState();
 *
 * echo ($switchable->state() ? 'true' : 'false');
 * // example output: false
 *
 * ```
 */
interface Switchable
{

    /**
     * Return the current boolean state.
     *
     * @return bool
     *
     * @example
     *
     * ```
     * echo ($switchable->state() ? 'true' : 'false');
     * // example output: true
     *
     * ```
     *
     */
    public function state(): bool;

    /**
     * Switch the current boolean state.
     *
     * @return void
     *
     * @example
     *
     * ```
     * echo ($switchable->state() ? 'true' : 'false');
     * // example output: true
     *
     * $switchable->switchState();
     *
     * echo ($switchable->state() ? 'true' : 'false');
     * // example output: false
     *
     * ```
     *
     */
    public function switchState(): void;

}

