<?php

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

    public function getParentPrivateNullableProperty(): ?int
    {
        return $this->parentPrivateNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getParentPrivateClosureProperty(): Closure
    {
        $this->parentPrivateClosureProperty = function(): void {};
        return $this->parentPrivateClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getParentPrivateArrayProperty(): array
    {
        return $this->parentPrivateArrayProperty;
    }

    /**
     * @return bool
     */
    public function getParentPrivateBoolProperty(): bool
    {
        return $this->parentPrivateBoolProperty;
    }

    /**
     * @return float
     */
    public function getParentPrivateFloatProperty(): float
    {
        return $this->parentPrivateFloatProperty;
    }

    /**
     * @return int
     */
    public function getParentPrivateIntProperty(): int
    {
        return $this->parentPrivateIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getParentPrivateUnionTypeProperty(): int|bool|string
    {
        return $this->parentPrivateUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getParentPrivateMixedProperty(): mixed
    {
        return $this->parentPrivateMixedProperty;
    }

    /**
     * @return object
     */
    public function getParentPrivateObjectProperty(): object
    {
        $this->parentPrivateObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentPrivateObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getParentProtectedNullableProperty(): ?int
    {
        return $this->parentProtectedNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getParentProtectedClosureProperty(): Closure
    {
        $this->parentProtectedClosureProperty = function(): void {};
        return $this->parentProtectedClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getParentProtectedArrayProperty(): array
    {
        return $this->parentProtectedArrayProperty;
    }

    /**
     * @return bool
     */
    public function getParentProtectedBoolProperty(): bool
    {
        return $this->parentProtectedBoolProperty;
    }

    /**
     * @return float
     */
    public function getParentProtectedFloatProperty(): float
    {
        return $this->parentProtectedFloatProperty;
    }

    /**
     * @return int
     */
    public function getParentProtectedIntProperty(): int
    {
        return $this->parentProtectedIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getParentProtectedUnionTypeProperty(): int|bool|string
    {
        return $this->parentProtectedUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getParentProtectedMixedProperty(): mixed
    {
        return $this->parentProtectedMixedProperty;
    }

    /**
     * @return object
     */
    public function getParentProtectedObjectProperty(): object
    {
        $this->parentProtectedObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentProtectedObjectProperty;
    }

    /**
     * @return ?int
     */
    public function getParentPublicNullableProperty(): ?int
    {
        return $this->parentPublicNullableProperty;
    }

    /**
     * @return Closure
     */
    public function getParentPublicClosureProperty(): Closure
    {
        $this->parentPublicClosureProperty = function(): void {};
        return $this->parentPublicClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public function getParentPublicArrayProperty(): array
    {
        return $this->parentPublicArrayProperty;
    }

    /**
     * @return bool
     */
    public function getParentPublicBoolProperty(): bool
    {
        return $this->parentPublicBoolProperty;
    }

    /**
     * @return float
     */
    public function getParentPublicFloatProperty(): float
    {
        return $this->parentPublicFloatProperty;
    }

    /**
     * @return int
     */
    public function getParentPublicIntProperty(): int
    {
        return $this->parentPublicIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public function getParentPublicUnionTypeProperty(): int|bool|string
    {
        return $this->parentPublicUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public function getParentPublicMixedProperty(): mixed
    {
        return $this->parentPublicMixedProperty;
    }

    /**
     * @return object
     */
    public function getParentPublicObjectProperty(): object
    {
        $this->parentPublicObjectProperty = (object) ['foo' => 'bar'];
        return $this->parentPublicObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getParentPrivateStaticNullableProperty(): ?int
    {
        return self::$parentPrivateStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getParentPrivateStaticClosureProperty(): Closure
    {
        self::$parentPrivateStaticClosureProperty = static function(): void {};
        return self::$parentPrivateStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getParentPrivateStaticArrayProperty(): array
    {
        return self::$parentPrivateStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getParentPrivateStaticBoolProperty(): bool
    {
        return self::$parentPrivateStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getParentPrivateStaticFloatProperty(): float
    {
        return self::$parentPrivateStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getParentPrivateStaticIntProperty(): int
    {
        return self::$parentPrivateStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getParentPrivateStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentPrivateStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getParentPrivateStaticMixedProperty(): mixed
    {
        return self::$parentPrivateStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getParentPrivateStaticObjectProperty(): object
    {
        self::$parentPrivateStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentPrivateStaticObjectProperty;
    }

    /**
     * @return ?int
     */
    public static function getParentProtectedStaticNullableProperty(): ?int
    {
        return self::$parentProtectedStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getParentProtectedStaticClosureProperty(): Closure
    {
        self::$parentProtectedStaticClosureProperty = static function(): void {};
        return self::$parentProtectedStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getParentProtectedStaticArrayProperty(): array
    {
        return self::$parentProtectedStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getParentProtectedStaticBoolProperty(): bool
    {
        return self::$parentProtectedStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getParentProtectedStaticFloatProperty(): float
    {
        return self::$parentProtectedStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getParentProtectedStaticIntProperty(): int
    {
        return self::$parentProtectedStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getParentProtectedStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentProtectedStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getParentProtectedStaticMixedProperty(): mixed
    {
        return self::$parentProtectedStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getParentProtectedStaticObjectProperty(): object
    {
        self::$parentProtectedStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentProtectedStaticObjectProperty;
    }


    /**
     * @return ?int
     */
    public static function getParentPublicStaticNullableProperty(): ?int
    {
        return self::$parentPublicStaticNullableProperty;
    }

    /**
     * @return Closure
     */
    public static function getParentPublicStaticClosureProperty(): Closure
    {
        self::$parentPublicStaticClosureProperty = static function(): void {};
        return self::$parentPublicStaticClosureProperty;
    }

    /**
     * @return array<mixed>
     */
    public static function getParentPublicStaticArrayProperty(): array
    {
        return self::$parentPublicStaticArrayProperty;
    }

    /**
     * @return bool
     */
    public static function getParentPublicStaticBoolProperty(): bool
    {
        return self::$parentPublicStaticBoolProperty;
    }

    /**
     * @return float
     */
    public static function getParentPublicStaticFloatProperty(): float
    {
        return self::$parentPublicStaticFloatProperty;
    }

    /**
     * @return int
     */
    public static function getParentPublicStaticIntProperty(): int
    {
        return self::$parentPublicStaticIntProperty;
    }

    /**
     * @return int|bool|string
     */
    public static function getParentPublicStaticUnionTypeProperty(): int|bool|string
    {
        return self::$parentPublicStaticUnionTypeProperty;
    }

    /**
     * @return mixed
     */
    public static function getParentPublicStaticMixedProperty(): mixed
    {
        return self::$parentPublicStaticMixedProperty;
    }

    /**
     * @return object
     */
    public static function getParentPublicStaticObjectProperty(): object
    {
        self::$parentPublicStaticObjectProperty = (object) ['foo' => 'bar'];
        return self::$parentPublicStaticObjectProperty;
    }

}
