<?php

namespace roady\classes\utilities;

use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionProperty;
use roady\classes\utilities\Reflection;
use roady\interfaces\utilities\ObjectReflection as ObjectReflectionInterface;

class ObjectReflection extends Reflection implements ObjectReflectionInterface
{

    /**
     * Instantiate a new ObjectReflection of the specified object
     * instance.
     *
     * @param object $object The object to reflect.
     *
     * @example
     *
     * ```
     * $reflection = new \roady\classes\utilities\ObjectReflection(
     *                   new \stdclass()
     *               );
     *
     * ```
     *
     */
    public function __construct(
        private object $object
    ) {
        parent::__construct($this->newReflectionClass($object));
    }

    public function propertyValues(): array
    {
        $properties = $this->reflectionClass()->getProperties();
        $propertyValues = array();
        foreach ($properties as $property) {
            $this->addPropertyValueToArray(
                $property,
                $this->reflectedObject(),
                $propertyValues
            );
        }
        $this->addParentPropertyValuesToArray(
            $this->reflectedObject(),
            $propertyValues
        );
        return $propertyValues;
    }

    public function reflectedObject(): object
    {
        return $this->object;
    }

    /**
     * Add the values of the properties defined by the parent
     * classes of the of specified object to the specified array.
     *
     * Index the values by the name of the property they are
     * assigned to.
     *
     * Note: If the specified array already contains a value indexed
     * under the name of one of the parent properties, the existing
     * value will be preserved, and the parent property's value will
     * not be added to the array.
     *
     * Note: Uninitialized properties will be assigned the value null.
     *
     * @param object $object The object whose parent's property's
     *                       values should be added to the specified
     *                       array.
     *
     * @param array<string, mixed> $propertyValues The array to add
     *                                             the property
     *                                             values to.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $propertyValues = [];
     * $this->addParentPropertyValuesToArray(
     *     $this->reflectedObject(),
     *     $propertyValues
     * );
     *
     * ```
     *
     */
    private function addParentPropertyValuesToArray(
        object $object,
        array &$propertyValues
    ): void
    {
        $reflectionClass = $this->reflectionClass();
        while($parent = $reflectionClass->getParentClass()) {
            foreach($parent->getProperties() as $property) {
                if(!isset($propertyValues[$property->getName()])) {
                    $this->addPropertyValueToArray(
                        $property,
                        $object,
                        $propertyValues
                    );
                }
            }
            $reflectionClass = $parent;
        }
    }

    /**
     * Return an instance of a ReflectionClass to reflect the
     * specified object instance.
     *
     * @param object $object The object instance the ReflectionClass
     *                       instance will reflect.
     *
     * @return ReflectionClass <object>
     *
     * @example
     *
     * ```
     * $this->newReflectionClass($this->reflectedObject());
     *
     * ```
     *
     */
    private function newReflectionClass(object $object): ReflectionClass
    {
        return new ReflectionClass($object);
    }

    /**
     * Add the value of the specified property to the specified
     * array.
     *
     * Index the values by the name of the property they are
     * assigned to.
     *
     * @param ReflectionProperty $property An instance of a
     *                                     ReflectionProperty that
     *                                     reflects the target
     *                                     property.
     *
     * @param object $object The object instance that defined the
     *                       property.
     *
     * @param array<string, mixed> $propertyValues The array to add
     *                                             the property's
     *                                             value to.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->addPropertyValueToArray(
     *     $property,
     *     $object,
     *     $propertyValues
     * );
     *
     * ```
     *
     */
    private function addPropertyValueToArray(
        ReflectionProperty $property,
        object $object,
        array &$propertyValues
    ): void
    {
        if($property->isInitialized($object)) {
            $property->setAccessible(true);
            $propertyValues[$property->getName()] =
                $property->getValue($object);
        } else{
            $propertyValues[$property->getName()] =
                null;
        }
    }
}

