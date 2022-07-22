Note: This document is still being drafted, and will evolve over time.

# Code Style

### Interfaces

The following is an example of the basic format roady interfaces
should adhere to.

```
<?php

namespace roady\approrpiate\namespace;

use namespace\interface\that\will\be\extended\TheInterfaceToExtend;

/**
 * A description of the purpose of this Interface.
 *
 * Methods:
 *
 * ```
 * public function aMethod(bool $parameter): bool;
 *
 * ```
 *
 * Methods inherited from TheInterfaceToExtend:
 *
 * ```
 * public function aMethodInheritedFromTheInterfaceToExtend(): int;
 *
 * ```
 *
 */
interface ThisInterface extends TheInterfaceToExtend
{

    /**
     * Description of the purpose of this method.
     *
     * @param bool $parameter Descrption of the purpose of this
     *                        parameter.
     *
     * @return bool
     *
     * @example
     *
     * ```
     * echo (
     *     $instance->aMethod(true)
     *     ? 'True'
     *     : 'False'
     * );
     * // example output: True
     *
     * echo (
     *     $instance->aMethod(false)
     *     ? 'True'
     *     : 'False'
     * );
     * // example output: False
     *
     * ```
     *
     */
    public function aMethod(bool $parameter): bool;

}

```


