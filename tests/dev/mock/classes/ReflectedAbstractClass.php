<?php

namespace tests\dev\mock\classes;

use \Closure;
use \stdClass;

/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */
abstract class ReflectedAbstractClass
{

    private ?int $parentPrivateNullableProperty = null;
    private Closure $parentPrivateClosureProperty;
    /**
     * @var array<mixed> $parentPrivateArrayProperty
     */
    private array $parentPrivateArrayProperty = [];
    private bool $parentPrivateBoolProperty = false;
    private float $parentPrivateFloatProperty = 0.0;
    private int $parentPrivateIntProperty = 0;
    private int|bool|string $parentPrivateUnionTypeProperty = true;
    private mixed $parentPrivateMixedProperty = null;
    private object $parentPrivateObjectProperty;
    private static ?int $parentPrivateStaticNullableProperty = null;
    private static Closure $parentPrivateStaticClosureProperty;
    /**
     * @var array<mixed> $parentPrivateStaticArrayProperty
     */
    private static array $parentPrivateStaticArrayProperty = [];
    private static bool $parentPrivateStaticBoolProperty = false;
    private static float $parentPrivateStaticFloatProperty = 0.0;
    private static int $parentPrivateStaticIntProperty = 0;
    private static int|bool|string $parentPrivateStaticUnionTypeProperty = true;
    private static mixed $parentPrivateStaticMixedProperty = null;
    private static object $parentPrivateStaticObjectProperty;
    protected ?int $parentProtectedNullableProperty = null;
    protected Closure $parentProtectedClosureProperty;
    /**
     * @var array<mixed> $parentProtectedArrayProperty
     */
    protected array $parentProtectedArrayProperty = [];
    protected bool $parentProtectedBoolProperty = false;
    protected float $parentProtectedFloatProperty = 0.0;
    protected int $parentProtectedIntProperty = 0;
    protected int|bool|string $parentProtectedUnionTypeProperty = true;
    protected mixed $parentProtectedMixedProperty = null;
    protected object $parentProtectedObjectProperty;
    protected static ?int $parentProtectedStaticNullableProperty = null;
    protected static Closure $parentProtectedStaticClosureProperty;
    /**
     * @var array<mixed> $parentProtectedStaticArrayProperty
     */
    protected static array $parentProtectedStaticArrayProperty = [];
    protected static bool $parentProtectedStaticBoolProperty = false;
    protected static float $parentProtectedStaticFloatProperty = 0.0;
    protected static int $parentProtectedStaticIntProperty = 0;
    protected static int|bool|string $parentProtectedStaticUnionTypeProperty = true;
    protected static mixed $parentProtectedStaticMixedProperty = null;
    protected static object $parentProtectedStaticObjectProperty;
    public ?int $parentPublicNullableProperty = null;
    public Closure $parentPublicClosureProperty;
    /**
     * @var array<mixed> $parentPublicArrayProperty
     */
    public array $parentPublicArrayProperty = [];
    public bool $parentPublicBoolProperty = false;
    public float $parentPublicFloatProperty = 0.0;
    public int $parentPublicIntProperty = 0;
    public int|bool|string $parentPublicUnionTypeProperty = true;
    public mixed $parentPublicMixedProperty = null;
    public object $parentPublicObjectProperty;
    public static ?int $parentPublicStaticNullableProperty = null;
    public static Closure $parentPublicStaticClosureProperty;
    /**
     * @var array<mixed> $parentPublicStaticArrayProperty
     */
    public static array $parentPublicStaticArrayProperty = [];
    public static bool $parentPublicStaticBoolProperty = false;
    public static float $parentPublicStaticFloatProperty = 0.0;
    public static int $parentPublicStaticIntProperty = 0;
    public static int|bool|string $parentPublicStaticUnionTypeProperty = true;
    public static mixed $parentPublicStaticMixedProperty = null;
    public static object $parentPublicStaticObjectProperty;

    abstract protected function abstractProtectedFunction(): void;
    abstract public function abstractPublicFunction(): void;
    abstract protected static function abstractProtectedStaticFunction(): void;
    abstract public static function abstractPublicStaticFunction(): void;

    abstract public static function abstractPublicAcceptsAStringFunction(string $string): void;
    abstract public static function abstractPublicAcceptsAIntFunction(int $int): void;
    abstract public static function abstractPublicAcceptsAFloatFunction(float $float): void;
    abstract public static function abstractPublicAcceptsABoolFunction(bool $bool): void;
    abstract public static function abstractPublicAcceptsAObjectFunction(object $object): void;
    /**
     * @param array<mixed> $array
     */
    abstract public static function abstractPublicAcceptsAArrayFunction(array $array): void;
    abstract public static function abstractPublicAcceptsAClosureFunction(Closure $closure): void;
    abstract public static function abstractPublicAcceptsAIntBoolFunction(int|bool $unionType): void;
    abstract public static function abstractPublicAcceptsAStringOrNullFunction(?string $string): void;

    public function getPrivateNullableProperty(): ?int
    {
        return $this->parentPrivateNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getPrivateClosureProperty(): Closure
    {
        $this->parentPrivateClosureProperty = function(): void {};
        return $this->parentPrivateClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getPrivateArrayProperty(): array
    {
        return $this->parentPrivateArrayProperty;
    }

    /**
     * @return bool
     */
    public function getPrivateBoolProperty(): bool
    {
        return $this->parentPrivateBoolProperty;
    }

    /**
     * @return float
     */
    public function getPrivateFloatProperty(): float
    {
        return $this->parentPrivateFloatProperty;
    }

    /**
     * @return int
     */
    public function getPrivateIntProperty(): int
    {
        return $this->parentPrivateIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getPrivateUnionTypeProperty(): int|bool|string
    {
        return $this->parentPrivateUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getPrivateMixedProperty(): mixed
    {
        return $this->parentPrivateMixedProperty;
    }

    /**
     * @return object
     */
    public function getPrivateObjectProperty(): object
    {
        $this->parentPrivateObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentPrivateObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getProtectedNullableProperty(): ?int
    {
        return $this->parentProtectedNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getProtectedClosureProperty(): Closure
    {
        $this->parentProtectedClosureProperty = function(): void {};
        return $this->parentProtectedClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getProtectedArrayProperty(): array
    {
        return $this->parentProtectedArrayProperty;
    }

    /**
     * @return bool
     */
    public function getProtectedBoolProperty(): bool
    {
        return $this->parentProtectedBoolProperty;
    }

    /**
     * @return float
     */
    public function getProtectedFloatProperty(): float
    {
        return $this->parentProtectedFloatProperty;
    }

    /**
     * @return int
     */
    public function getProtectedIntProperty(): int
    {
        return $this->parentProtectedIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getProtectedUnionTypeProperty(): int|bool|string
    {
        return $this->parentProtectedUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getProtectedMixedProperty(): mixed
    {
        return $this->parentProtectedMixedProperty;
    }

    /**
     * @return object
     */
    public function getProtectedObjectProperty(): object
    {
        $this->parentProtectedObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentProtectedObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getPublicNullableProperty(): ?int
    {
        return $this->parentPublicNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getPublicClosureProperty(): Closure
    {
        $this->parentPublicClosureProperty = function(): void {};
        return $this->parentPublicClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getPublicArrayProperty(): array
    {
        return $this->parentPublicArrayProperty;
    }

    /**
     * @return bool
     */
    public function getPublicBoolProperty(): bool
    {
        return $this->parentPublicBoolProperty;
    }

    /**
     * @return float
     */
    public function getPublicFloatProperty(): float
    {
        return $this->parentPublicFloatProperty;
    }

    /**
     * @return int
     */
    public function getPublicIntProperty(): int
    {
        return $this->parentPublicIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getPublicUnionTypeProperty(): int|bool|string
    {
        return $this->parentPublicUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getPublicMixedProperty(): mixed
    {
        return $this->parentPublicMixedProperty;
    }

    /**
     * @return object
     */
    public function getPublicObjectProperty(): object
    {
        $this->parentPublicObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentPublicObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getPrivateStaticNullableProperty(): ?int
    {
        return self::$parentPrivateStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getPrivateStaticClosureProperty(): Closure
    {
        self::$parentPrivateStaticClosureProperty = static function(): void {};
        return self::$parentPrivateStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getPrivateStaticArrayProperty(): array
    {
        return self::$parentPrivateStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getPrivateStaticBoolProperty(): bool
    {
        return self::$parentPrivateStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getPrivateStaticFloatProperty(): float
    {
        return self::$parentPrivateStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getPrivateStaticIntProperty(): int
    {
        return self::$parentPrivateStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getPrivateStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentPrivateStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getPrivateStaticMixedProperty(): mixed
    {
        return self::$parentPrivateStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getPrivateStaticObjectProperty(): object
    {
        self::$parentPrivateStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentPrivateStaticObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getProtectedStaticNullableProperty(): ?int
    {
        return self::$parentProtectedStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getProtectedStaticClosureProperty(): Closure
    {
        self::$parentProtectedStaticClosureProperty = static function(): void {};
        return self::$parentProtectedStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getProtectedStaticArrayProperty(): array
    {
        return self::$parentProtectedStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getProtectedStaticBoolProperty(): bool
    {
        return self::$parentProtectedStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getProtectedStaticFloatProperty(): float
    {
        return self::$parentProtectedStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getProtectedStaticIntProperty(): int
    {
        return self::$parentProtectedStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getProtectedStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentProtectedStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getProtectedStaticMixedProperty(): mixed
    {
        return self::$parentProtectedStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getProtectedStaticObjectProperty(): object
    {
        self::$parentProtectedStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentProtectedStaticObjectProperty;
    }


    /**
     * @return ?int
     */
    public static function getPublicStaticNullableProperty(): ?int
    {
        return self::$parentPublicStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getPublicStaticClosureProperty(): Closure
    {
        self::$parentPublicStaticClosureProperty = static function(): void {};
        return self::$parentPublicStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getPublicStaticArrayProperty(): array
    {
        return self::$parentPublicStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getPublicStaticBoolProperty(): bool
    {
        return self::$parentPublicStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getPublicStaticFloatProperty(): float
    {
        return self::$parentPublicStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getPublicStaticIntProperty(): int
    {
        return self::$parentPublicStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getPublicStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentPublicStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getPublicStaticMixedProperty(): mixed
    {
        return self::$parentPublicStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getPublicStaticObjectProperty(): object
    {
        self::$parentPublicStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentPublicStaticObjectProperty;
    }

    private function parentPrivateMethodToReturnAString(): string
    {
        return 'a string';
    }

    private function parentPrivateMethodToReturnABool(): bool
    {
        return true;
    }

    private function parentPrivateMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    private function parentPrivateMethodToReturnAInt(): int
    {
        return 42;
    }

    private function parentPrivateMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    private function parentPrivateMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    private function parentPrivateMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    private function parentPrivateMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    private function parentPrivateMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    private static function parentPrivateMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    private static function parentPrivateMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    private static function parentPrivateMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    private static function parentPrivateMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    private static function parentPrivateMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    private static function parentPrivateMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    private static function parentPrivateMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    private static function parentPrivateMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    private static function parentPrivateMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }


    protected function dumpAll(): void
    {
        var_dump(
            $this->parentPrivateMethodToReturnAString(),
            $this->parentPrivateMethodToReturnABool(),
            $this->parentPrivateMethodToReturnAFloat(),
            $this->parentPrivateMethodToReturnAInt(),
            $this->parentPrivateMethodToReturnAClosure(),
            $this->parentPrivateMethodToReturnAObject(),
            $this->parentPrivateMethodToReturnAArray(),
            $this->parentPrivateMethodToReturnABoolOrInt(),
            $this->parentPrivateMethodToReturnAStringOrNull(),
            self::parentPrivateMethodToReturnAStaticString(),
            self::parentPrivateMethodToReturnAStaticBool(),
            self::parentPrivateMethodToReturnAStaticFloat(),
            self::parentPrivateMethodToReturnAStaticInt(),
            self::parentPrivateMethodToReturnAStaticClosure(),
            self::parentPrivateMethodToReturnAStaticObject(),
            self::parentPrivateMethodToReturnAStaticArray(),
            self::parentPrivateMethodToReturnAStaticBoolOrInt(),
            self::parentPrivateMethodToReturnAStaticStringOrNull(),
        );
    }

    protected function dumpInstance(): void
    {
        var_dump(
            $this->parentPrivateMethodToReturnAString(),
            $this->parentPrivateMethodToReturnABool(),
            $this->parentPrivateMethodToReturnAFloat(),
            $this->parentPrivateMethodToReturnAInt(),
            $this->parentPrivateMethodToReturnAClosure(),
            $this->parentPrivateMethodToReturnAObject(),
            $this->parentPrivateMethodToReturnAArray(),
            $this->parentPrivateMethodToReturnABoolOrInt(),
            $this->parentPrivateMethodToReturnAStringOrNull(),
        );
    }

    protected static function dumpStatic(): void
    {
        var_dump(
            self::parentPrivateMethodToReturnAStaticString(),
            self::parentPrivateMethodToReturnAStaticBool(),
            self::parentPrivateMethodToReturnAStaticFloat(),
            self::parentPrivateMethodToReturnAStaticInt(),
            self::parentPrivateMethodToReturnAStaticClosure(),
            self::parentPrivateMethodToReturnAStaticObject(),
            self::parentPrivateMethodToReturnAStaticArray(),
            self::parentPrivateMethodToReturnAStaticBoolOrInt(),
            self::parentPrivateMethodToReturnAStaticStringOrNull(),
        );
    }

    protected function parentProtectedMethodToReturnAString(): string
    {
        return 'a string';
    }

    protected function parentProtectedMethodToReturnABool(): bool
    {
        return true;
    }

    protected function parentProtectedMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    protected function parentProtectedMethodToReturnAInt(): int
    {
        return 42;
    }

    protected function parentProtectedMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    protected function parentProtectedMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    protected function parentProtectedMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    protected function parentProtectedMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    protected function parentProtectedMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    protected static function parentProtectedMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    protected static function parentProtectedMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    protected static function parentProtectedMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    protected static function parentProtectedMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    protected static function parentProtectedMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    protected static function parentProtectedMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    protected static function parentProtectedMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    protected static function parentProtectedMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    protected static function parentProtectedMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }

    public function parentPublicMethodToReturnAString(): string
    {
        return 'a string';
    }

    public function parentPublicMethodToReturnABool(): bool
    {
        return true;
    }

    public function parentPublicMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    public function parentPublicMethodToReturnAInt(): int
    {
        return 42;
    }

    public function parentPublicMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    public function parentPublicMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    public function parentPublicMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    public function parentPublicMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    public function parentPublicMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    public static function parentPublicMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    public static function parentPublicMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    public static function parentPublicMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    public static function parentPublicMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    public static function parentPublicMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    public static function parentPublicMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    public static function parentPublicMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    public static function parentPublicMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    public static function parentPublicMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }
}
