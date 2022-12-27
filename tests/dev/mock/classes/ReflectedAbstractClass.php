<?php
/**
    private function privateParentMethodWithNoParameters(): void
    private function privateParentMethodWithParameters(
    protected function protectedParentMethodWithNoParameters(): void
    protected function protectedParentMethodWithParameters(
    public function publicParentMethodWithNoParameters(): void
    public function publicParentMethodWithParameters(
    public static function staticParentMethodWithNoParameters():void
    public static function staticParentMethodWithParameters(
 */
namespace tests\dev\mock\classes;

use \Closure;

/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */
abstract class ReflectedAbstractClass
{

    private function privateParentMethodWithNoParameters(): void
    {
        $this::staticParentMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    private function privateParentMethodWithParameters(
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
        $this->privateParentMethodWithNoParameters();
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

    protected function protectedParentMethodWithNoParameters(): void
    {
        $this->protectedParentMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    protected function protectedParentMethodWithParameters(
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
        $this->privateParentMethodWithParameters(
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

    public function publicParentMethodWithNoParameters(): void
    {
        $this->protectedParentMethodWithNoParameters();
    }

    /**
     * Parent method that expects parameters of varying type.
     *
     * @param array<mixed> $arrayParameter
     *
     * @return void
     *
     */
    public function publicParentMethodWithParameters(
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
        $this->protectedParentMethodWithParameters(
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

    public static function staticParentMethodWithNoParameters():void
    {
        var_dump(phpinfo());
    }

    public static function staticParentMethodWithParameters(
        ReflectedAbstractClass $parameter1,
        object|bool|null $parameter2 = null
    ): bool
    {
        var_dump($parameter1);
        return ($parameter2 instanceof ReflectedAbstractClass);
    }

}
