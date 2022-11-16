<?php

namespace roady\classes\constituents;

use roady\interfaces\constituents\Switchable as SwitchableInterface;

class Switchable implements SwitchableInterface
{

    /**
     * Instantiate a new Switchable instance.
     *
     * @param bool $state The initial state to assign to the
     *                    Switchable.
     *
     * @example
     *
     * ```
     * $switchable = new Switchable(true);
     *
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
    public function __construct(private bool $state) {}

    public function state(): bool
    {
        return $this->state;
    }

    public function switchState(): void
    {
        $this->state = (
            $this->state()
            ? false
            : true
        );
    }

}

