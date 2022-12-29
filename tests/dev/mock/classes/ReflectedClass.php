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
    public static function getStaticPrivateNullableProperty(): ?int
    {
        return self::$privateStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getStaticPrivateClosureProperty(): Closure
    {
        self::$privateStaticClosureProperty = static function(): void {};
        return self::$privateStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getStaticPrivateArrayProperty(): array
    {
        return self::$privateStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getStaticPrivateBoolProperty(): bool
    {
        return self::$privateStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getStaticPrivateFloatProperty(): float
    {
        return self::$privateStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getStaticPrivateIntProperty(): int
    {
        return self::$privateStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getStaticPrivateUnionTypeProperty(): int|bool|string
    {
        return self::$privateStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getStaticPrivateMixedProperty(): mixed
    {
        return self::$privateStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getStaticPrivateObjectProperty(): object
    {
        self::$privateStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$privateStaticObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getStaticProtectedNullableProperty(): ?int
    {
        return self::$protectedStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getStaticProtectedClosureProperty(): Closure
    {
        self::$protectedStaticClosureProperty = static function(): void {};
        return self::$protectedStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getStaticProtectedArrayProperty(): array
    {
        return self::$protectedStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getStaticProtectedBoolProperty(): bool
    {
        return self::$protectedStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getStaticProtectedFloatProperty(): float
    {
        return self::$protectedStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getStaticProtectedIntProperty(): int
    {
        return self::$protectedStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getStaticProtectedUnionTypeProperty(): int|bool|string
    {
        return self::$protectedStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getStaticProtectedMixedProperty(): mixed
    {
        return self::$protectedStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getStaticProtectedObjectProperty(): object
    {
        self::$protectedStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$protectedStaticObjectProperty;
    }


    /**
     * @return ?int
     */
    public static function getStaticPublicNullableProperty(): ?int
    {
        return self::$publicStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getStaticPublicClosureProperty(): Closure
    {
        self::$publicStaticClosureProperty = static function(): void {};
        return self::$publicStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getStaticPublicArrayProperty(): array
    {
        return self::$publicStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getStaticPublicBoolProperty(): bool
    {
        return self::$publicStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getStaticPublicFloatProperty(): float
    {
        return self::$publicStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getStaticPublicIntProperty(): int
    {
        return self::$publicStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getStaticPublicUnionTypeProperty(): int|bool|string
    {
        return self::$publicStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getStaticPublicMixedProperty(): mixed
    {
        return self::$publicStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getStaticPublicObjectProperty(): object
    {
        self::$publicStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$publicStaticObjectProperty;
    }
}
