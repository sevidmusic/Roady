<?php

namespace DarlingCms\abstractions\utility;

use DarlingCms\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionParameter;
use \Exception;
use \ReflectionException;

abstract class ReflectionUtility implements ReflectionUtilityInterface
{
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

    /** @noinspection DuplicatedCode */
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

    private function logError($sprintFormattedMessage, string ...$sprints)
    {
        $msgArr = [$sprintFormattedMessage];
        $args = array_merge($msgArr, $sprints);
        error_log(PHP_EOL . call_user_func_array('sprintf', $args));
    }

}
