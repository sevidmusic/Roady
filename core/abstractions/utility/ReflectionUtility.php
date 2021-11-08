<?php

namespace roady\abstractions\utility;

use ReflectionProperty;
use roady\dev\traits\Logger;
use roady\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionNamedType;

abstract class ReflectionUtility implements ReflectionUtilityInterface
{
    use Logger;

    private const FAILED_TO_REFLECT_MOCK_STD_METHOD = <<<EOD
ReflectionUtility Fatal Error:
The specified method %s() could not be reflected for class %s,
and also failed to default to an empty instance of stdClass().
EOD;

    private const FAILED_TO_REFLECT_CLASS_METHOD = <<<EOD
ReflectionUtility Error:
The specified method %s() could not be reflected for class %s.
Defaulting to stdClass().
EOD;

    private const METHOD_DOES_NOT_EXIST = <<<EOD
ReflectionUtility Warning:
The specified method %s() is not defined in class %s.
You may safely ignore this warning if this is expected.
EOD;

    private const RANDOM_BYTES_FAILED = <<<EOD
ReflectionUtility Warning:
Failed to generate alpha-numeric string using random_bytes(),
defaulting to str_shuffle(). You can safely ignore this warning
if the generated string does not need to be cryptographically secure.
EOD;

    private const INVALID_CLASS_PARAMETER = <<<EOD
'ReflectionUtility Error:
Invalid type %s passed to %s'
EOD;

    private const FAILED_TO_REFLECT_CLASS = <<<EOD
ReflectionUtility Error:
Failed to reflect class %s. Defaulting to reflect empty
stdClass() instance.
EOD;

    private const CONSTRUCT = '__construct';
    private const BOOLEAN = 'boolean';
    private const INTEGER = 'integer';
    private const DOUBLE = 'double';
    private const STRING = 'string';
    private const ARRAY = 'array';
    private const NULL = 'NULL';

    public function getClassPropertyNames(string|object $class): array
    {
        $propertyNames = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        return array_unique($propertyNames);
    }

    /**
     * @param class-string<object>|object $class
     * @return array<int, ReflectionProperty>
     */
    private function getClassPropertyReflections(string|object $class): array
    {
        $selfReflection = $this->getClassReflection($class);
        if ($selfReflection->getParentClass() === false) {
            return $selfReflection->getProperties();
        }
        $propertyReflections = $selfReflection->getProperties();
        while ($parent = $selfReflection->getParentClass()) {
            $propertyReflections = array_merge($propertyReflections, $parent->getProperties());
            $selfReflection = $parent;
        }
        return $propertyReflections;
    }

    public function getClassReflection(string|object $class): ReflectionClass
    {
        try {
            return new ReflectionClass($class);
        } catch (ReflectionException $e) {
            $this->log(
                self::FAILED_TO_REFLECT_CLASS,
                $this->getClass($class)
            );
            return new ReflectionClass((object)[]);
        }
    }

    private function getClass(string|object $class): string
    {
        return (is_string($class) ? $class : get_class($class));
    }

    public function getClassPropertyTypes(string|object $class): array
    {
        $propertyTypes = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            try {
                $propertyTypes[strval($reflectionProperty->getName())] = gettype(
                    $reflectionProperty->getValue($this->getClassInstance($class))
                );
            } catch (ReflectionException $e) {
                return [];
            }
        }
        return $propertyTypes;
    }

    public function getClassInstance(string|object $class, array $constructorArguments = array()): object
    {
        if (method_exists($class, self::CONSTRUCT) === false) {
            try {
                return $this->getClassReflection($class)->newInstanceArgs([]);
            } catch (ReflectionException $e) {
                return $e;
            }
        }
        if (empty($constructorArguments) === true) {
            try {
                return $this->getClassReflection($class)->newInstanceArgs($this->generateMockClassMethodArguments($class, self::CONSTRUCT));
            } catch (ReflectionException $e) {
                return $e;
            }
        }
        return $this->getClassReflection($class)->newInstanceArgs($constructorArguments);
    }

    public function generateMockClassMethodArguments(string|object $class, string $method): array
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
            if ($type === self::ARRAY) {
                array_push($defaults, array());
                continue;
            }
            if ($type === self::NULL) {
                array_push($defaults, null);
                continue;
            }
            /**
             * For unknown types assume class instance.
             * @var class-string<object>|object $type
             */
            $type = '\\' . str_replace(['roady\interfaces'], ['roady\classes'], $type);
            try {
                array_push($defaults, $this->getClassInstance($type));
            } catch (ReflectionException $e) {
                return [];
            }
        }
        return $defaults;
    }

    public function getClassMethodParameterTypes(string|object $class, string $method): array
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

    private function getClassMethodReflection(string|object $class, string $methodName): ReflectionMethod|null
    {
        if (method_exists($class, $methodName) === false) {
            $this->log(self::METHOD_DOES_NOT_EXIST,
                $methodName,
                $this->getClass($class)
            );
            return null;
        }
        return $this->getMethodReflection($class, $methodName);
    }

    private function getMethodReflection(string|object $class, string $methodName): ReflectionMethod
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
        $type = $reflectionParameter->getType();
        /**
         * @var ReflectionNamedType $type
         * Note:
         *   ReflectionType::__toString() was deprecated in PHP 7.1.0,
         *   ReflectionParameter::getType() now returns an instance of
         *   ReflectionNamedType.
         *   @see https://www.php.net/manual/en/class.reflectionnamedtype.php.
         *   @see https://www.php.net/manual/en/class.reflectionnamedtype.php
         */
        return $this->convertReflectionTypeStringToGettypeString($type->getName());
    }

    private function convertReflectionTypeStringToGettypeString(string $type): string
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
            $randomAplhaNumChars = preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(12));
            return (
                is_string($randomAplhaNumChars)
                ? $randomAplhaNumChars
                : str_shuffle(
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz' .
                    strval(rand(PHP_INT_MIN, PHP_INT_MAX))
                )
            );
        } catch (Exception $e) {
            $this->log(self::RANDOM_BYTES_FAILED
            );
            return str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz');
        }
    }

    public function getClassPropertyValues(string|object $class): array
    {
        $propertyValues = array();
        foreach ($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            try {
                $propertyValues[strval($reflectionProperty->getName())] = (
                is_string($class) === true
                    ? $reflectionProperty->getValue($this->getClassInstance($class))
                    : $reflectionProperty->getValue($class)
                );
            } catch (ReflectionException $e) {
                return [];
            }
        }
        return $propertyValues;
    }

    public function getClassMethodParameterNames(string|object $class, string $method): array
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
