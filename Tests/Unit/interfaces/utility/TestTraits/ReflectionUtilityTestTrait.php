<?php /** @noinspection PhpUnused */

namespace UnitTests\interfaces\utility\TestTraits;

use DarlingCms\interfaces\utility\ReflectionUtility;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;
use UnitTests\TestTraits\ArrayTester;

trait ReflectionUtilityTestTrait
{

    use ArrayTester;

    /**
     * @var ReflectionUtility
     */
    private $reflectionUtility;

    /**
     * @var Baz|Bazzer|Foo|Bar
     */
    private $classToReflect;

    /**
     * @before
     */
    public function initializeClassToReflect()
    {
        $this->classToReflect = $this->getRandomClassInstanceOrFullyQualifiedClassname();
    }

    protected function setReflectionUtility(ReflectionUtility $reflectionUtility): void
    {
        $this->reflectionUtility = $reflectionUtility;
    }

    protected function getReflectionUtility(): ReflectionUtility
    {
        return $this->reflectionUtility;
    }

    private function getClassToReflect()
    {
        return $this->classToReflect;
    }

    private function getRandomClassInstanceOrFullyQualifiedClassname()
    {
        $testClasses = array(
            new Baz(),
            new Bazzer(),
            new Foo(true, 234987, 420.234, 'Some string', array([], [1, 2, 3], true), new Bar('Bar string'), null),
            new Bar('Some bar string'),
            '\UnitTests\interfaces\utility\TestTraits\Baz',
            '\UnitTests\interfaces\utility\TestTraits\Bazzer',
            '\UnitTests\interfaces\utility\TestTraits\Foo',
            '\UnitTests\interfaces\utility\TestTraits\Bar'
        );
        return $testClasses[array_rand($testClasses)];
    }

    public function testGetClassPropertyNamesReturnsArrayWhoseValuesAreSpecifiedClassesExpectedPropertyNames(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassPropertyNames($this->getClassToReflect()),
            $this->getReflectionUtility()->getClassPropertyNames($this->getClassToReflect())
        );
    }

    public function testGetClassPropertyTypesReturnsArrayWhoseValuesAreSpecifiedClassesExpectedPropertyTypes(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassPropertyTypes($this->getClassToReflect()),
            $this->getReflectionUtility()->getClassPropertyTypes($this->getClassToReflect())
        );
    }

    public function testGetClassPropertyValuesReturnsInstancesValues(): void
    {
        $instance = $this->getClassInstance($this->getClassToReflect());
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassPropertyValues($instance),
            $this->getReflectionUtility()->getClassPropertyValues($instance)
        );
    }

    public function testGetClassInstanceReturnsInstanceOfSpecifiedClass(): void
    {
        $this->assertEquals(
            $this->getFullyQualifiedClassname($this->getClassToReflect()),
            '\\' . get_class($this->getReflectionUtility()->getClassInstance($this->getClassToReflect()))
        );
        $this->assertEquals(
            get_class($this->getClassInstance($this->getClassToReflect())),
            get_class($this->getReflectionUtility()->getClassInstance($this->getClassToReflect()))
        );
    }

    public function testGenerateMockClassMethodArgumentsReturnsArrayWhoseValuesTypesAreMethodsExpectedArgumentTypes(): void
    {
        $generatedTypes = array();
        foreach ($this->getReflectionUtility()->generateMockClassMethodArguments($this->getClassToReflect(), '__construct') as $argumentValue) {
            array_push($generatedTypes, $this->getRealType($argumentValue));
        }
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassMethodParameterTypes($this->getClassToReflect(), '__construct'),
            $generatedTypes
        );
    }

    public function testGetClassMethodParameterNamesReturnsArrayWhoseValuesAreSpecifiedClassMethodsParameterNames(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassMethodParameterNames($this->getClassToReflect(), '__construct'),
            $this->getReflectionUtility()->getClassMethodParameterNames($this->getClassToReflect(), '__construct')
        );
    }

    public function testGetClassMethodParameterTypesReturnsArrayWhoseValuesAreSpecifiedClassMethodsExpectedParameterTypes(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getClassMethodParameterTypes($this->getClassToReflect(), '__construct'),
            $this->getReflectionUtility()->getClassMethodParameterTypes($this->getClassToReflect(), '__construct')
        );
    }

    public function getClassPropertyNames($class): array
    {
        $propertyNames = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        return array_unique($propertyNames);
    }

    public function getClassPropertyTypes($class): array
    {
        $propertyTypes = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyTypes[$reflectionProperty->getName()] = gettype(
                $reflectionProperty->getValue($this->getClassInstance($class))
            );
        }
        return $propertyTypes;
    }

    public function getClassPropertyValues($class): array
    {
        $propertyValues = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyValues[$reflectionProperty->getName()] = (
            is_string($class) === true
                ? $reflectionProperty->getValue($this->getClassInstance($class))
                : $reflectionProperty->getValue($class)
            );
        }
        return $propertyValues;
    }

    public function getClassInstance($class, array $constructorArguments = array())
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassInstance()') === false) {
            return (object)[];
        }
        if (method_exists($class, '__construct') === false) {
            return $this->getClassReflection($class)->newInstanceArgs([]);
        }
        if (empty($constructorArguments) === true) {
            return $this->getClassReflection($class)->newInstanceArgs($this->generateMockClassMethodArguments($class, '__construct'));
        }
        return $this->getClassReflection($class)->newInstanceArgs($constructorArguments);
    }

    private function getRealType($var): string
    {
        if (gettype($var) === 'object') {
            return get_class($var);
        }
        return gettype($var);
    }

    private function getClass($class): string
    {
        return (is_string($class) ? $class : get_class($class));
    }

    private function getClassReflection($class): ReflectionClass
    {
        try {
            return new ReflectionClass($class);
        } catch (ReflectionException $e) {
            $this->logError(<<<EOD
ReflectionUtilityTestTrait Error: Failed to reflect class %s.
Defaulting to reflect empty stdClass() instance.
EOD
                , $this->getClass($class)
            );
            try {
                return new ReflectionClass((object)[]);
            } catch (ReflectionException $e) {
                $this->logError(<<<EOD
ReflectionUtilityTestTrait Fatal Error: Failed to reflect class %s,
and also failed to reflect empty stdClass() by default.
EOD
                    , $this->getClass($class)
                );
                exit(0);
            }
        }
    }

    public function getClassMethodParameterNames($class, string $method): array
    {
        $parameterNames = array();
        $methodReflection = $this->getClassMethodReflection($class, $method);
        if (is_null($methodReflection) === true) {
            return array();
        }
        foreach ($methodReflection->getParameters() as $reflectionParameter) {
            array_push($parameterNames, $reflectionParameter->name);
        }
        return $parameterNames;
    }

    public function getClassMethodParameterTypes($class, string $method): array
    {
        $parameterTypes = array();
        $methodReflection = $this->getClassMethodReflection($class, $method);
        if (is_null($methodReflection) === true) {
            return array();
        }
        foreach ($methodReflection->getParameters() as $reflectionParameter) {
            array_push($parameterTypes, $this->getParameterType($reflectionParameter));
        }
        return $parameterTypes;
    }

    /** @noinspection DuplicatedCode */
    public function generateMockClassMethodArguments($class, string $method): array
    {
        $defaults = array();
        foreach ($this->getClassMethodParameterTypes($class, $method) as $type) {
            if ($type === 'boolean') {
                array_push($defaults, false);
                continue;
            }
            if ($type === 'integer') {
                array_push($defaults, 1);
                continue;
            }
            if ($type === 'double') {
                array_push($defaults, 1.2345);
                continue;
            }
            if ($type === 'string') {
                array_push($defaults, $this->generateRandomAlphaNumString());
                continue;
            }
            if ($type === 'array') {
                array_push($defaults, array());
                continue;
            }
            if ($type === 'NULL') {
                array_push($defaults, null);
                continue;
            }
            /** For unknown types assume class instance. */
            array_push($defaults, $this->getClassInstance('\\' . $type));
        }
        return $defaults;
    }


    private function classParameterIsValidClassNameOrClassInstance($class, string $caller): bool
    {
        if (is_string($class) === false && is_object($class) === false) {
            error_log(
                sprintf(
                    'ReflectionUtilityTestTrait Error: Invalid type %s passed to %s',
                    gettype($class),
                    $caller
                )
            );
            return false;
        }
        return true;
    }

    private function getClassPropertyReflections($class): array
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassPropertyReflections()') === false) {
            return array();
        }
        $selfReflection = $this->getClassReflection($class);
        if ($selfReflection->getParentClass() === false) {
            return $selfReflection->getProperties();
        }
        return array_merge(
            $selfReflection->getParentClass()->getProperties(),
            $selfReflection->getProperties()
        );
    }

    /**
     * @noinspection SpellCheckingInspection
     */
    private function generateRandomAlphaNumString(): string
    {
        try {
            return preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(12));
        } catch (Exception $e) {
            $this->logError(<<<EOD
ReflectionUtilityTestTrait Warning: 
Failed to generate alpha-numeric string using random_bytes(), defaulting to 
str_shuffle(). You can safely ignore this warning if the generated string 
does not need to be cryptographically secure.
EOD
            );
            return str_shuffle('A1BCD2EFGH3IJKL4MNOPQ5RSTUVW6XYZabcd7efghijkl8mnop9qrs0tuvwxyz');
        }
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    private function getParameterType(ReflectionParameter $reflectionParameter): string
    {
        if (is_null($reflectionParameter->getType()) === true) {
            return 'NULL';
        }
        return $this->convertReflectionTypeStringToGettypeString($reflectionParameter->getType()->getName());
    }

    private function convertReflectionTypeStringToGettypeString(string $type)
    {
        if ($type === 'bool') {
            return 'boolean';
        }
        if ($type === 'float') {
            return 'double';
        }
        if ($type === 'int') {
            return 'integer';
        }
        return $type;
    }

    private function getClassMethodReflection($class, string $methodName)
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassMethodReflection()') === false) {
            return null;
        }
        if (method_exists($class, $methodName) === false) {
            $this->logError(<<<EOD
ReflectionUtilityTestTrait Warning: 
The specified method %s() is not defined in class %s. 
You may safely ignore this warning if this is expected.
EOD
                , $methodName,
                $this->getClass($class)
            );
            return null;
        }
        return $this->getMethodReflection($class, $methodName);
    }

    private function getMethodReflection($class, string $methodName): ReflectionMethod
    {
        try {
            return new ReflectionMethod($this->getClass($class), $methodName);
        } catch (ReflectionException $e) {
            $this->logError(<<<EOD
ReflectionUtilityTestTrait Error: 
The specified method %s() could not be reflected for class %s. 
Defaulting to stdClass().
EOD
                , $methodName,
                $this->getClass($class)
            );
            try {
                return new ReflectionMethod((object)[], $methodName);
            } catch (ReflectionException $e) {
                $this->logError(<<<EOD
ReflectionUtilityTestTrait Fatal Error: 
The specified method %s() could not be reflected for class %s, 
and also failed to default to an empty instance of stdClass().
EOD
                    , $methodName,
                    $this->getClass($class)
                );
                exit();
            }
        }
    }

    private function getFullyQualifiedClassname($class)
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, 'getFullyQualifiedClassname') === false) {
            return '\\' . get_class((object)[]);
        }
        return (is_string($class) ? $class : '\\' . get_class($class));
    }

    private function logError($sprintFormattedMessage, string ...$sprints)
    {
        $msgArr = [$sprintFormattedMessage];
        $args = array_merge($msgArr, $sprints);
        error_log(PHP_EOL . call_user_func_array('sprintf', $args));
    }

}

/**
 * The following classes are used by the ReflectionUtilityTestTrait to test the
 * \DarlingCms\abstractions\utility\ReflectionUtility class's methods.
 */
class Baz
{
    public $fooBarBaz = array();

    public function getFooBarBaz(): array
    {
        return $this->fooBarBaz;
    }
}

class Bazzer extends Baz
{
    private $baz = '12345';

    public function getBaz(): string
    {
        return sprintf('%s: %s', $this->baz, json_encode($this->getFooBarBaz()));
    }
}

class Foo extends Bazzer
{
    protected $bool;
    private $int;
    public $float;
    protected $str;
    private $arr;
    private $null;
    protected $bar;

    public function __construct(bool $bool, int $int, float $float, string $str, array $arr, Bar $bar, $null = null)
    {
        $this->bool = $bool;
        $this->int = $int;
        $this->float = $float;
        $this->str = $str . $this->getBaz();
        $this->arr = $arr;
        $this->null = $null;
        $this->bar = $bar;
    }
}

class Bar
{
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }
}
