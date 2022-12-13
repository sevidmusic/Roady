<?php

namespace tests\dev\mock\classes;

use tests\dev\mock\classes\ReflectedAbstractClass;

/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */

class ReflectedClass extends ReflectedAbstractClass
{

    public const PUBLIC_CONSTANT = 1;

    public function __construct(
        private bool $foo,
        protected int $baz
    ){}

    public function foo(): bool
    {
        return $this->privateMethod();
    }

    public function bar(): int
    {
        return $this->protectedMethod();
    }

    private function privateMethod(): bool
    {
        return $this->foo;
    }

    protected function protectedMethod(): int
    {
        return $this->finalMethod();
    }

    public static function staticMethod(bool $foo, int $baz): string
    {
        $instance = new ReflectedClass($foo, $baz);
        return strval($instance->foo()) . strval($instance->bar());
    }

    final protected function finalMethod(): int {
        return $this->baz + self::PUBLIC_CONSTANT;
    }

}
