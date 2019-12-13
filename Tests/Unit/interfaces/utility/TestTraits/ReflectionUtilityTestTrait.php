<?php

namespace UnitTests\interfaces\utility\TestTraits;

use UnitTests\TestUtilities\ArrayTestUtility;
use \ReflectionClass;
use \ReflectionProperty;
use \ReflectionMethod;
use \ReflectionParameter;
use \Exception;

trait ReflectionUtilityTestTrait {

    protected $arrayTestUtility;


    //private $classToReflect = '\UnitTests\interfaces\utility\TestTraits\Baz';
    //private $classToReflect = '\UnitTests\interfaces\utility\TestTraits\Bazzer';
     private $classToReflect = '\UnitTests\interfaces\utility\TestTraits\Foo';
    //private $classToReflect = '\UnitTests\interfaces\utility\TestTraits\Bar';

    /**
     * @before
     */
    public function initializeArraryTestUtility() {
        $this->arrayTestUtility = new ArrayTestUtility();
    }

    public function testGetClassPropertyNamesReturnsArrayWhoseValuesAreSpecifiedClassesExpectedPropertyNames() {
        $this->arrayTestUtility->arraysAreEqual(
            $this->getClassPropertyNames($this->classToReflect),
            $this->reflectionUtility->getClassPropertyNames($this->classToReflect)
        );
    }

    public function testGetClassPropertyTypesReturnsArrayWhoseValuesAreSpecifiedClassesExpectedPropertyTypes() {
        $this->arrayTestUtility->arraysAreEqual(
            $this->getClassPropertyTypes($this->classToReflect),
            $this->reflectionUtility->getClassPropertyTypes($this->classToReflect)
        );
    }

    public function testGetClassPropertyValuesReturnsInstancesValues() {
        $instance = $this->getClassInstance($this->classToReflect);
        $this->arrayTestUtility->arraysAreEqual(
            $this->getClassPropertyValues($instance),
            $this->reflectionUtility->getClassPropertyValues($instance)
        );
    }

    public function testGetClassInstanceReturnsInstanceOfSpecifiedClass() {
        $this->assertEquals(
            $this->classToReflect,
            '\\' . get_class($this->reflectionUtility->getClassInstance($this->classToReflect))
        );
        $this->assertEquals(
            get_class($this->getClassInstance($this->classToReflect)),
            get_class($this->reflectionUtility->getClassInstance($this->classToReflect))
        );
    }

    public function testGenerateMockClassMethodArgumentsReturnsArrayWhoseValuesTypesAreMethodsExpectedArgumentTypes() {
        $generatedTypes = array();
        foreach($this->reflectionUtility->generateMockClassMethodArguments($this->classToReflect, '__construct') as $argumentValue) {
            $argumentType = gettype($argumentValue);
            if($argumentType === 'object') {
                array_push($generatedTypes, get_class($argumentValue));
                continue;
            }
            array_push($generatedTypes, $argumentType);
        }
        $this->arrayTestUtility->arraysAreEqual(
            $this->getClassMethodParameterTypes($this->classToReflect, '__construct'),
            $generatedTypes
       );
    }

    public function testGetClassMethodParameterNamesReturnsArrayWhoseValuesAreSpecifiedClassMethodsParameterNames() {
        $this->arrayTestUtility->arraysAreEqual(
            $this->getClassMethodParameterNames($this->classToReflect, '__construct'),
            $this->reflectionUtility->getClassMethodParameterNames($this->classToReflect, '__construct')
        );
    }

    // testGetClassMethodParameterTypesReturns...
    private function getClassPropertyNames($class) {
        $propertyNames = array();
        foreach($this->getClassPropertyReflections($class) as $reflectionProperty) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        return array_unique($propertyNames);
    }

    private function getClassPropertyTypes($class):array {
        $propertyTypes = array();
        foreach($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyTypes[$reflectionProperty->getName()] = gettype(
                $reflectionProperty->getValue($this->getClassInstance($class))
            );
        }
        return $propertyTypes;
    }

    private function getClassPropertyValues($class):array {
       $propertyValues = array();
        foreach($this->getClassPropertyReflections($class) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyValues[$reflectionProperty->getName()] = (
                is_string($class) === true
                ? $reflectionProperty->getValue($this->getClassInstance($class))
                : $reflectionProperty->getValue($class)
            );
        }
        return $propertyValues;
    }

    private function getClassInstance($class, array $constructorArguments = array()) {
       if($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassInstance()') === false) {
           return (object) [];
       }
       $reflection = new ReflectionClass($class);
       if(method_exists($class, '__construct') === false) {return $reflection->newInstanceArgs([]);}
       if(empty($constructorArguments) === true) {
           return $reflection->newInstanceArgs($this->generateMockClassMethodArguments($class, '__construct'));
       }
       return $reflection->newInstanceArgs($constructorArguments);
    }

    private function generateMockClassMethodArguments($class, string $method) : array {
        $defaults = array();
        foreach($this->getClassMethodParameterTypes($class, $method) as $type) {
            if($type === 'boolean') {array_push($defaults, false); continue;}
            if($type === 'integer') {array_push($defaults, 1); continue;}
            if($type === 'double') {array_push($defaults, 1.2345); continue;}
            if($type === 'string') {
                array_push($defaults, $this->generateRandomAlphaNumString());
                continue;
            }
            if($type === 'array') {array_push($defaults, array()); continue;}
            if($type === 'NULL') {array_push($defaults, null); continue;}
            /** For unknown tyoes assume class instance. */
            array_push($defaults, $this->getClassInstance('\\' . $type));
        }
        return $defaults;
    }

    private function getClassMethodParameterNames($class, string $method): array {
        $parameterNames = array();
        foreach($this->getClassMethodReflection($class, $method)->getParameters() as $reflectionParameter) {
            array_push($parameterNames, $reflectionParameter->name);
        }
        return $parameterNames;
    }

    private function getClassMethodParameterTypes($class, string $method): array {
        $parameterTypes = array();
        foreach($this->getClassMethodReflection($class, $method)->getParameters() as $reflectionParameter) {
            array_push($parameterTypes, $this->getParameterType($reflectionParameter));
        }
        return $parameterTypes;
    }

    private function classParameterIsValidClassNameOrClassInstance($class, string $caller):bool {
         if(is_string($class) === false && is_object($class) === false) {
            throw new Exception('ReflectionUtilityTestTrait Error: Invalid type ' .
                gettype($class) .' passed to ' . $caller);
            return false;
         }
         return true;
    }

    private function getClassPropertyReflections($class):array {
        if($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassPropertyReflections()') === false) {
            return array();
        }
        $selfReflection = new ReflectionClass($class);
        if($selfReflection->getParentClass() === false) {
            return $selfReflection->getProperties();
        }
        return array_merge(
            $selfReflection->getParentClass()->getProperties(),
            $selfReflection->getProperties()
        );
    }

    private function generateRandomAlphaNumString():string {
        return preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(12));
    }


    private function isPHPUnitMockProperty(ReflectionProperty $reflectionProperty):bool {
        return (mb_substr($reflectionProperty->getName(),0,8) === '__phpunit');
    }

    private function getParameterType(ReflectionParameter $reflectionParameter):string {
        $parameterType = $reflectionParameter->getType();
        if(is_null($parameterType) === true) { return 'NULL'; }
        return $this->convertReflectionTypeStringToGettypeString($parameterType->getName());
    }

    private function convertReflectionTypeStringToGettypeString(string $type) {
        if($type === 'bool') { return 'boolean'; }
        if($type === 'float') { return 'double'; }
        if($type === 'int') { return 'integer'; }
        return $type;
    }

    private function getClassMethodReflection($class, string $methodName) {
        if($this->classParameterIsValidClassNameOrClassInstance($class, 'getClassMethodReflection()') === false) {
            return null;
        }
        if(method_exists($class, $methodName) === false) {
            throw new Exception('ReflectionUtiltiy Error: The specified method ' .
                                 $methodName . ' is not defined.');
            return null;
        }
        return (gettype($class) === 'string'
            ? new ReflectionMethod($class, $methodName)
            : new ReflectionMethod(get_class($class), $methodName)
        );
    }

}

class Baz {
    public $fooBarBaz = array();
}

class Bazzer extends Baz {
    private $baz = '12345';
}

class Foo extends Bazzer {
    protected $bool;
    private $int;
    public $float;
    protected $str;
    private $arr;
    private $null;
    protected $bar;

    public function __construct(bool $bool, int $int, float $float, string $str, array $arr, $null = null, Bar $bar) {
        $this->bool = $bool;
        $this->int = $int;
        $this->float = $float;
        $this->str = $str;
        $this->arr = $arr;
        $this->null = $null;
        $this->bar = $bar;
    }
}

class Bar {
    private $str;
    public function __construct(string $str) {
        $this->str = $str;
    }
}
