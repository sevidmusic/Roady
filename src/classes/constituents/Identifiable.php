<?php

namespace roady\classes\constituents;

use roady\classes\strings\ClassString;
use roady\interfaces\constituents\Identifiable as IdentifiableInterface;
use roady\interfaces\strings\ClassString as ClassStringInterface;
use roady\interfaces\strings\Id;
use roady\interfaces\strings\Name;

class Identifiable implements IdentifiableInterface
{

    /**
     * Instantiate a new Identifiable instance.
     *
     * @param Name $name The Name to assign.
     *
     * @param Id $id The Id to assign.
     *
     * @example
     *
     * ```
     * $identifiable = new \roady\classes\constituents\Identifiable(
     *     new Name('Foo'),
     *     new Id(),
     * );
     *
     * ```
     *
     */
    public function __construct(
        private Name $name,
        private Id $id,
    ) {}

    public function name(): Name
    {
        return $this->name;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function type(): ClassStringInterface
    {
        return new ClassString($this);
    }
}

