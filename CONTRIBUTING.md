Note: This document is still being drafted, and will evolve over time.

# Code Style

### Naming Functions

Functions must be named using `camelCase`.

### Naming variables

Variables must be named using `camelCase`.

### Naming Methods

Methods must be named using `camleCase` with one exception:
test methods must be defined using `snake_case`.

Example class:

```
<?php

namespace roady\classes;

trait ExampleClass
{

    public function aMethodDefinedByTheClass(): void
    {
        // ...
    }

    public function anotherMethodDefinedByTheClass(): void
    {
        // ...
    }

}

```

Example test Trait:

```
<?php

namespace tests\interfaces;

trait TestTrait
{

    public function aMethodDefinedByTheTestTrait(): void
    {
        // ...
    }

    public function test_method_defined_by_the_test_trait(): void
    {
        // ...
    }

}

```

### Interfaces

All roady classes must implement a roady interface.

The following is an example of the basic format roady interfaces
should adhere to.

```
<?php

namespace roady\approrpiate\namespace;

use namespace\of\interface\that\will\be\extended\TheInterfaceToExtend;

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
 * @see TheInterfaceToExtend
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
     * @return string
     *
     * @example
     *
     * ```
     * echo $instance->aMethod(true);
     * // example output: True
     *
     * echo $instance->aMethod(false);
     * // example output: False
     *
     * ```
     *
     */
    public function aMethod(bool $parameter): string;

}

```
