<?php

namespace tests\dev\mock\classes;

use tests\dev\mock\classes\ReflectedAbstractClass;
use \Closure;

/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */

class ReflectedClass extends ReflectedAbstractClass
{

    private function privateMethodWithNoParameters(): void
    {
        $this::staticMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    private function privateMethodWithParameters(
        Closure $closureParameter,
        string $stringParameter,
        int $intParameter,
        float $floatParameter,
        bool $boolParameter,
        object $objectParameter,
        array $arrayParameter,
        mixed $mixedParameter,
        Closure|string|int|ReflectedAbstractClass $unionTypeParameter,
        bool|int|null $nullalbleRequiredParameter,
        ReflectedAbstractClass|null $nullalbleOptionalParameter= null
    ): void
    {
        var_dump(
            $closureParameter,
            $stringParameter,
            $intParameter,
            $floatParameter,
            $boolParameter,
            $objectParameter,
            $arrayParameter,
            $nullalbleRequiredParameter,
            $nullalbleOptionalParameter
        );
    }

    protected function protectedMethodWithNoParameters(): void
    {
        $this->privateMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    protected function protectedMethodWithParameters(
        Closure $closureParameter,
        string $stringParameter,
        int $intParameter,
        float $floatParameter,
        bool $boolParameter,
        object $objectParameter,
        array $arrayParameter,
        mixed $mixedParameter,
        Closure|string|int|ReflectedAbstractClass $unionTypeParameter,
        bool|int|null $nullalbleRequiredParameter,
        ReflectedAbstractClass|null $nullalbleOptionalParameter= null
    ): void
    {
        $this->privateMethodWithParameters(
            $closureParameter,
            $stringParameter,
            $intParameter,
            $floatParameter,
            $boolParameter,
            $objectParameter,
            $arrayParameter,
            $mixedParameter,
            $unionTypeParameter,
            $nullalbleRequiredParameter,
            $nullalbleOptionalParameter
        );
    }

    public function publicMethodWithNoParameters(): void
    {
        $this->protectedMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    public function publicMethodWithParameters(
        Closure $closureParameter,
        string $stringParameter,
        int $intParameter,
        float $floatParameter,
        bool $boolParameter,
        object $objectParameter,
        array $arrayParameter,
        mixed $mixedParameter,
        Closure|string|int|ReflectedAbstractClass $unionTypeParameter,
        bool|int|null $nullalbleRequiredParameter,
        ReflectedAbstractClass|null $nullalbleOptionalParameter= null
    ): void
    {
        $this->protectedMethodWithParameters(
            $closureParameter,
            $stringParameter,
            $intParameter,
            $floatParameter,
            $boolParameter,
            $objectParameter,
            $arrayParameter,
            $mixedParameter,
            $unionTypeParameter,
            $nullalbleRequiredParameter,
            $nullalbleOptionalParameter
        );
    }

    public static function staticMethodWithNoParameters():void
    {
        var_dump(phpinfo());
    }

    public static function staticMethodWithParameters(
        ReflectedAbstractClass $parameter1,
        object|bool|null $parameter2 = null
    ): bool
    {
        var_dump($parameter1);
        return ($parameter2 instanceof ReflectedAbstractClass);
    }

}
