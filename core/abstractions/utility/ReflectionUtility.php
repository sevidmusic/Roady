<?php

namespace DarlingCms\abstractions\utility;

use DarlingCms\dev\traits\Logger;
use DarlingCms\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

abstract class ReflectionUtility implements ReflectionUtilityInterface
{
    use Logger;

    const FAILED_TO_REFLECT_MOCK_STD_METHOD = <<<EOD
ReflectionUtilityTestTrait Fatal Error:
The specified method %s() could not be reflected for class %s,
and also failed to default to an empty instance of stdClass().
EOD;

    const FAILED_TO_REFLECT_CLASS_METHOD = <<<EOD
ReflectionUtilityTestTrait Error:
The specified method %s() could not be reflected for class %s.
Defaulting to stdClass().
EOD;

    const METHOD_DOES_NOT_EXIST = <<<EOD
ReflectionUtilityTestTrait Warning:
The specified method %s() is not defined in class %s.
You may safely ignore this warning if this is expected.
EOD;

    const RANDOM_BYTES_FAILED = <<<EOD
ReflectionUtilityTestTrait Warning:
Failed to generate alpha-numeric string using random_bytes(),
defaulting to str_shuffle(). You can safely ignore this warning
if the generated string does not need to be cryptographically secure.
EOD;

    const INVALID_CLASS_PARAMETER = <<<EOD
'ReflectionUtilityTestTrait Error: 
Invalid type %s passed to %s'
EOD;

    const FAILED_TO_REFLECT_CLASS = <<<EOD
ReflectionUtilityTestTrait Error: 
Failed to reflect class %s. Defaulting to reflect empty
stdClass() instance.
EOD;

    const FAILED_TO_REFLECT_MOCK_STD = <<<EOD
ReflectionUtilityTestTrait Fatal Error: 
Failed to reflect class %s, and also failed to reflect empty
stdClass() by default.
EOD;

    const CONSTRUCT = '__construct';
    const BOOLEAN = 'boolean';
    const INTEGER = 'integer';
    const DOUBLE = 'double';
    const STRING = 'string';
    const ARRAY1 = 'array';
    const NULL = 'NULL';

    public function getClassPropertyNames($class): array
    {
        $propertyNames = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        return array_unique($propertyNames);
    }

    private function getClassPropertyReflections($class): array
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, __METHOD__) === false) {
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

    private function classParameterIsValidClassNameOrClassInstance($class, string $caller): bool
    {
        if (is_string($class) === false && is_object($class) === false) {
            $this->log(
                self::INVALID_CLASS_PARAMETER,
                gettype($class),
                $caller
            );
            return false;
        }
        return true;
    }

    public function getClassReflection($class): ReflectionClass
    {
        try {
            return new ReflectionClass($class);
        } catch (ReflectionException $e) {
            $this->log(
                self::FAILED_TO_REFLECT_CLASS,
                $this->getClass($class)
            );
            try {
                return new ReflectionClass((object)[]);
            } catch (ReflectionException $e) {
                $this->log(
                    self::FAILED_TO_REFLECT_MOCK_STD,
                    $this->getClass($class)
                );
                exit(0);
            }
        }
    }

    private function getClass($class): string
    {
        return (is_string($class) ? $class : get_class($class));
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

    public function getClassInstance($class, array $constructorArguments = array())
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, __METHOD__) === false) {
            return (object)[];
        }
        if (method_exists($class, self::CONSTRUCT) === false) {
            return $this->getClassReflection($class)->newInstanceArgs([]);
        }
        if (empty($constructorArguments) === true) {
            return $this->getClassReflection($class)->newInstanceArgs($this->generateMockClassMethodArguments($class, self::CONSTRUCT));
        }
        return $this->getClassReflection($class)->newInstanceArgs($constructorArguments);
    }

    public function generateMockClassMethodArguments($class, string $method): array
    {
        $defaults = array();
        foreach ($this->getClassMethodParameterTypes($class, $method) as $type) {
            if ($type === self::BOOLEAN) {
                array_push($defaults, false);
                continue;
            }
            if ($type === self::INTEGER) {
                array_push($defaults, 1);
                continue;
            }
            if ($type === self::DOUBLE) {
                array_push($defaults, 1.2345);
                continue;
            }
            if ($type === self::STRING) {
                array_push($defaults, $this->generateRandomAlphaNumString());
                continue;
            }
            if ($type === self::ARRAY1) {
                array_push($defaults, array());
                continue;
            }
            if ($type === self::NULL) {
                array_push($defaults, null);
                continue;
            }
            /** For unknown types assume class instance. */
            array_push($defaults, $this->getClassInstance('\\' . $type));
        }
        return $defaults;
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

    private function getClassMethodReflection($class, string $methodName)
    {
        if ($this->classParameterIsValidClassNameOrClassInstance($class, __METHOD__) === false) {
            return null;
        }
        if (method_exists($class, $methodName) === false) {
            $this->log(self::METHOD_DOES_NOT_EXIST,
                $methodName,
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
            $this->log(self::FAILED_TO_REFLECT_CLASS_METHOD,
                $methodName,
                $this->getClass($class)
            );
            try {
                return new ReflectionMethod((object)[], $methodName);
            } catch (ReflectionException $e) {
                $this->log(
                    self::FAILED_TO_REFLECT_MOCK_STD_METHOD,
                    $methodName,
                    $this->getClass($class)
                );
                exit();
            }
        }
    }

    private function getParameterType(ReflectionParameter $reflectionParameter): string
    {
        if (is_null($reflectionParameter->getType()) === true) {
            return self::NULL;
        }
        return $this->convertReflectionTypeStringToGettypeString($reflectionParameter->getType()->getName());
    }

    private function convertReflectionTypeStringToGettypeString(string $type)
    {
        if ($type === 'bool') {
            return self::BOOLEAN;
        }
        if ($type === 'float') {
            return self::DOUBLE;
        }
        if ($type === 'int') {
            return self::INTEGER;
        }
        return $type;
    }

    private function generateRandomAlphaNumString(): string
    {
        try {
            return preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(12));
        } catch (Exception $e) {
            $this->log(self::RANDOM_BYTES_FAILED
            );
            return str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz');
        }
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

}
