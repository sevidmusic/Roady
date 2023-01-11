<?php

namespace tests\dev\mock\classes;

use \Closure;
use \stdClass;
use tests\dev\mock\classes\ReflectedAbstractClass;

/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */
class ReflectedBaseClass extends ReflectedAbstractClass
{
    private string $reflectedBaseFoo = 'Foo';
    protected float $reflectedBaseBar = 0.17;
    protected ?object $reflectedBaseBaz;

    public function __construct() {
        $this->reflectedBaseBaz = (object) [
            'reflectedBaseFoo' => $this->reflectedBaseFoo,
            'reflectedBaseBar' => $this->reflectedBaseBar,
        ];
    }

    private ?int $privateNullableProperty = null;
    private Closure $privateClosureProperty;
    /**
     * @var array<mixed> $privateArrayProperty
     */
    private array $privateArrayProperty = [];
    private bool $privateBoolProperty = false;
    private float $privateFloatProperty = 0.0;
    private int $privateIntProperty = 0;
    private int|bool|string $privateUnionTypeProperty = true;
    private mixed $privateMixedProperty = null;
    private object $privateObjectProperty;
    private static ?int $privateStaticNullableProperty = null;
    private static Closure $privateStaticClosureProperty;
    /**
     * @var array<mixed> $privateStaticArrayProperty
     */
    private static array $privateStaticArrayProperty = [];
    private static bool $privateStaticBoolProperty = false;
    private static float $privateStaticFloatProperty = 0.0;
    private static int $privateStaticIntProperty = 0;
    private static int|bool|string $privateStaticUnionTypeProperty = true;
    private static mixed $privateStaticMixedProperty = null;
    private static object $privateStaticObjectProperty;
    protected ?int $protectedNullableProperty = null;
    protected Closure $protectedClosureProperty;
    /**
     * @var array<mixed> $protectedArrayProperty
     */
    protected array $protectedArrayProperty = [];
    protected bool $protectedBoolProperty = false;
    protected float $protectedFloatProperty = 0.0;
    protected int $protectedIntProperty = 0;
    protected int|bool|string $protectedUnionTypeProperty = true;
    protected mixed $protectedMixedProperty = null;
    protected object $protectedObjectProperty;
    protected static ?int $protectedStaticNullableProperty = null;
    protected static Closure $protectedStaticClosureProperty;
    /**
     * @var array<mixed> $protectedStaticArrayProperty
     */
    protected static array $protectedStaticArrayProperty = [];
    protected static bool $protectedStaticBoolProperty = false;
    protected static float $protectedStaticFloatProperty = 0.0;
    protected static int $protectedStaticIntProperty = 0;
    protected static int|bool|string $protectedStaticUnionTypeProperty = true;
    protected static mixed $protectedStaticMixedProperty = null;
    protected static object $protectedStaticObjectProperty;
    public ?int $publicNullableProperty = null;
    public Closure $publicClosureProperty;
    /**
     * @var array<mixed> $publicArrayProperty
     */
    public array $publicArrayProperty = [];
    public bool $publicBoolProperty = false;
    public float $publicFloatProperty = 0.0;
    public int $publicIntProperty = 0;
    public int|bool|string $publicUnionTypeProperty = true;
    public mixed $publicMixedProperty = null;
    public object $publicObjectProperty;
    public static ?int $publicStaticNullableProperty = null;
    public static Closure $publicStaticClosureProperty;
    /**
     * @var array<mixed> $publicStaticArrayProperty
     */
    public static array $publicStaticArrayProperty = [];
    public static bool $publicStaticBoolProperty = false;
    public static float $publicStaticFloatProperty = 0.0;
    public static int $publicStaticIntProperty = 0;
    public static int|bool|string $publicStaticUnionTypeProperty = true;
    public static mixed $publicStaticMixedProperty = null;
    public static object $publicStaticObjectProperty;

    protected function abstractProtectedFunction(): void {}

    public function abstractPublicFunction(): void {}

    protected static function abstractProtectedStaticFunction(): void {}

    public static function abstractPublicStaticFunction(): void {}

    public static function abstractPublicAcceptsAStringFunction(
        string $string
    ): void {}

    public static function abstractPublicAcceptsAIntFunction(
        int $int
    ): void {}

    public static function abstractPublicAcceptsAFloatFunction(
        float $float
    ): void {}

    public static function abstractPublicAcceptsABoolFunction(
        bool $bool
    ): void {}

    public static function abstractPublicAcceptsAObjectFunction(
        object $object
    ): void {}
    /**
     * @param array<mixed> $array
     */
    public static function abstractPublicAcceptsAArrayFunction(
        array $array
    ): void {}

    public static function abstractPublicAcceptsAClosureFunction(
        Closure $closure
    ): void {}

    public static function abstractPublicAcceptsAIntBoolFunction(
        int|bool $unionType
    ): void {}

    public static function abstractPublicAcceptsAStringOrNullFunction(
        ?string $string
    ): void {}

    public function getPrivateNullableProperty(): ?int
    {
        return $this->privateNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getPrivateClosureProperty(): Closure
    {
        $this->privateClosureProperty = function(): void {};
        return $this->privateClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getPrivateArrayProperty(): array
    {
        return $this->privateArrayProperty;
    }

    /**
     * @return bool
     */
    public function getPrivateBoolProperty(): bool
    {
        return $this->privateBoolProperty;
    }

    /**
     * @return float
     */
    public function getPrivateFloatProperty(): float
    {
        return $this->privateFloatProperty;
    }

    /**
     * @return int
     */
    public function getPrivateIntProperty(): int
    {
        return $this->privateIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getPrivateUnionTypeProperty(): int|bool|string
    {
        return $this->privateUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getPrivateMixedProperty(): mixed
    {
        return $this->privateMixedProperty;
    }

    /**
     * @return object
     */
    public function getPrivateObjectProperty(): object
    {
        $this->privateObjectProperty = (object) ['foo' => 'bar'];
        return $this->privateObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getProtectedNullableProperty(): ?int
    {
        return $this->protectedNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getProtectedClosureProperty(): Closure
    {
        $this->protectedClosureProperty = function(): void {};
        return $this->protectedClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getProtectedArrayProperty(): array
    {
        return $this->protectedArrayProperty;
    }

    /**
     * @return bool
     */
    public function getProtectedBoolProperty(): bool
    {
        return $this->protectedBoolProperty;
    }

    /**
     * @return float
     */
    public function getProtectedFloatProperty(): float
    {
        return $this->protectedFloatProperty;
    }

    /**
     * @return int
     */
    public function getProtectedIntProperty(): int
    {
        return $this->protectedIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getProtectedUnionTypeProperty(): int|bool|string
    {
        return $this->protectedUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getProtectedMixedProperty(): mixed
    {
        return $this->protectedMixedProperty;
    }

    /**
     * @return object
     */
    public function getProtectedObjectProperty(): object
    {
        $this->protectedObjectProperty = (object) ['foo' => 'bar'];
        return $this->protectedObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getPublicNullableProperty(): ?int
    {
        return $this->publicNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getPublicClosureProperty(): Closure
    {
        $this->publicClosureProperty = function(): void {};
        return $this->publicClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getPublicArrayProperty(): array
    {
        return $this->publicArrayProperty;
    }

    /**
     * @return bool
     */
    public function getPublicBoolProperty(): bool
    {
        return $this->publicBoolProperty;
    }

    /**
     * @return float
     */
    public function getPublicFloatProperty(): float
    {
        return $this->publicFloatProperty;
    }

    /**
     * @return int
     */
    public function getPublicIntProperty(): int
    {
        return $this->publicIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getPublicUnionTypeProperty(): int|bool|string
    {
        return $this->publicUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getPublicMixedProperty(): mixed
    {
        return $this->publicMixedProperty;
    }

    /**
     * @return object
     */
    public function getPublicObjectProperty(): object
    {
        $this->publicObjectProperty = (object) ['foo' => 'bar'];
        return $this->publicObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getPrivateStaticNullableProperty(): ?int
    {
        return self::$privateStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getPrivateStaticClosureProperty(): Closure
    {
        self::$privateStaticClosureProperty = static function(): void {};
        return self::$privateStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getPrivateStaticArrayProperty(): array
    {
        return self::$privateStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getPrivateStaticBoolProperty(): bool
    {
        return self::$privateStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getPrivateStaticFloatProperty(): float
    {
        return self::$privateStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getPrivateStaticIntProperty(): int
    {
        return self::$privateStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getPrivateStaticUnionTypeProperty(): int|bool|string
    {
        return self::$privateStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getPrivateStaticMixedProperty(): mixed
    {
        return self::$privateStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getPrivateStaticObjectProperty(): object
    {
        self::$privateStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$privateStaticObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getProtectedStaticNullableProperty(): ?int
    {
        return self::$protectedStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getProtectedStaticClosureProperty(): Closure
    {
        self::$protectedStaticClosureProperty = static function(): void {};
        return self::$protectedStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getProtectedStaticArrayProperty(): array
    {
        return self::$protectedStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getProtectedStaticBoolProperty(): bool
    {
        return self::$protectedStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getProtectedStaticFloatProperty(): float
    {
        return self::$protectedStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getProtectedStaticIntProperty(): int
    {
        return self::$protectedStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getProtectedStaticUnionTypeProperty(): int|bool|string
    {
        return self::$protectedStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getProtectedStaticMixedProperty(): mixed
    {
        return self::$protectedStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getProtectedStaticObjectProperty(): object
    {
        self::$protectedStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$protectedStaticObjectProperty;
    }


    /**
     * @return ?int
     */
    public static function getPublicStaticNullableProperty(): ?int
    {
        return self::$publicStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getPublicStaticClosureProperty(): Closure
    {
        self::$publicStaticClosureProperty = static function(): void {};
        return self::$publicStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getPublicStaticArrayProperty(): array
    {
        return self::$publicStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getPublicStaticBoolProperty(): bool
    {
        return self::$publicStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getPublicStaticFloatProperty(): float
    {
        return self::$publicStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getPublicStaticIntProperty(): int
    {
        return self::$publicStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getPublicStaticUnionTypeProperty(): int|bool|string
    {
        return self::$publicStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getPublicStaticMixedProperty(): mixed
    {
        return self::$publicStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getPublicStaticObjectProperty(): object
    {
        self::$publicStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$publicStaticObjectProperty;
    }

    private function privateMethodToReturnAString(): string
    {
        return 'a string';
    }

    private function privateMethodToReturnABool(): bool
    {
        return true;
    }

    private function privateMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    private function privateMethodToReturnAInt(): int
    {
        return 42;
    }

    private function privateMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    private function privateMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    private function privateMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    private function privateMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    private function privateMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    private static function privateMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    private static function privateMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    private static function privateMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    private static function privateMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    private static function privateMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    private static function privateMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    private static function privateMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    private static function privateMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    private static function privateMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }


    protected function dumpAll(): void
    {
        var_dump(
            $this->privateMethodToReturnAString(),
            $this->privateMethodToReturnABool(),
            $this->privateMethodToReturnAFloat(),
            $this->privateMethodToReturnAInt(),
            $this->privateMethodToReturnAClosure(),
            $this->privateMethodToReturnAObject(),
            $this->privateMethodToReturnAArray(),
            $this->privateMethodToReturnABoolOrInt(),
            $this->privateMethodToReturnAStringOrNull(),
            self::privateMethodToReturnAStaticString(),
            self::privateMethodToReturnAStaticBool(),
            self::privateMethodToReturnAStaticFloat(),
            self::privateMethodToReturnAStaticInt(),
            self::privateMethodToReturnAStaticClosure(),
            self::privateMethodToReturnAStaticObject(),
            self::privateMethodToReturnAStaticArray(),
            self::privateMethodToReturnAStaticBoolOrInt(),
            self::privateMethodToReturnAStaticStringOrNull(),
        );
    }

    protected function dumpInstance(): void
    {
        var_dump(
            $this->privateMethodToReturnAString(),
            $this->privateMethodToReturnABool(),
            $this->privateMethodToReturnAFloat(),
            $this->privateMethodToReturnAInt(),
            $this->privateMethodToReturnAClosure(),
            $this->privateMethodToReturnAObject(),
            $this->privateMethodToReturnAArray(),
            $this->privateMethodToReturnABoolOrInt(),
            $this->privateMethodToReturnAStringOrNull(),
        );
    }

    protected static function dumpStatic(): void
    {
        var_dump(
            self::privateMethodToReturnAStaticString(),
            self::privateMethodToReturnAStaticBool(),
            self::privateMethodToReturnAStaticFloat(),
            self::privateMethodToReturnAStaticInt(),
            self::privateMethodToReturnAStaticClosure(),
            self::privateMethodToReturnAStaticObject(),
            self::privateMethodToReturnAStaticArray(),
            self::privateMethodToReturnAStaticBoolOrInt(),
            self::privateMethodToReturnAStaticStringOrNull(),
        );
    }

    protected function protectedMethodToReturnAString(): string
    {
        return 'a string';
    }

    protected function protectedMethodToReturnABool(): bool
    {
        return true;
    }

    protected function protectedMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    protected function protectedMethodToReturnAInt(): int
    {
        return 42;
    }

    protected function protectedMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    protected function protectedMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    protected function protectedMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    protected function protectedMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    protected function protectedMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    protected static function protectedMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    protected static function protectedMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    protected static function protectedMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    protected static function protectedMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    protected static function protectedMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    protected static function protectedMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    protected static function protectedMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    protected static function protectedMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    protected static function protectedMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }

    public function publicMethodToReturnAString(): string
    {
        return 'a string';
    }

    public function publicMethodToReturnABool(): bool
    {
        return true;
    }

    public function publicMethodToReturnAFloat(): float
    {
        return 3.14;
    }

    public function publicMethodToReturnAInt(): int
    {
        return 42;
    }

    public function publicMethodToReturnAClosure(): Closure
    {
        return function(): void {};
    }

    public function publicMethodToReturnAObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    public function publicMethodToReturnAArray(): array
    {
        return [1, 2, 3];
    }

    public function publicMethodToReturnABoolOrInt(): bool|int
    {
        if (rand(1, 100) <= 50) {
            return true;
        }

        return 42;
    }

    public function publicMethodToReturnAStringOrNull(): ?string
    {
        if (rand(1, 100) >= 50) {
            return 'some string';
        }

        return null;
    }

    public static function publicMethodToReturnAStaticString(): string
    {
        return 'some string';
    }

    public static function publicMethodToReturnAStaticBool(): bool
    {
        return true;
    }

    public static function publicMethodToReturnAStaticFloat(): float
    {
        return 3.14;
    }

    public static function publicMethodToReturnAStaticInt(): int
    {
        return 42;
    }

    public static function publicMethodToReturnAStaticClosure(): Closure
    {
        return function():void {};
    }

    public static function publicMethodToReturnAStaticObject(): object
    {
        return new stdClass();
    }

    /**
     * @return array<mixed>
     */
    public static function publicMethodToReturnAStaticArray(): array
    {
        return [1, 2, 3];
    }

    public static function publicMethodToReturnAStaticBoolOrInt(): bool|int
    {
        if (rand(1, 100) === 50) {
            return true;
        }

        return 42;
    }

    public static function publicMethodToReturnAStaticStringOrNull(): ?string
    {
        if (rand(1, 100) === 50) {
            return 'some string';
        }

        return null;
    }
}
