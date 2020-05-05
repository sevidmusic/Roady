<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\classes\utility\ReflectionUtility;
use DarlingCms\dev\traits\Logger;
use DarlingCms\interfaces\primary\Exportable as ExportableInterface;
use DarlingCms\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

abstract class Exportable extends Classifiable implements ExportableInterface
{
    use Logger;

    const PROP_NOT_DEFINED_IN_CLASS = <<<EOD
Exportable Notice:
Exportable type "%s" was unable to get property "%s" in preparation
for import(). Looking for property in parent class.
EOD;
    const PROP_NOT_DEFINED_IN_PARENT = <<<EOD
Exportable Error:
Exportable type "%s" was unable to get property "%s" in preparation
for import() from parent class. Defaulting to mocking via an stdClass
instance to attempt to avoid shutdown.
EOD;
    const MOCK_STD_FAILED = <<<EOD
Exportable Fatal Error:
Exportable type "%s" was unable to get property "%s" in preparation
for import() from mock stdClass instance. Shutting down.
EOD;
    private $reflectionUtility;

    public function __construct()
    {
        parent::__construct();
        $this->setReflectionUtility(new ReflectionUtility());
    }

    private function setReflectionUtility(ReflectionUtilityInterface $reflectionUtility)
    {
        $this->reflectionUtility = $reflectionUtility;
    }

    public function import(array $export): bool
    {
        foreach ($export as $propertyName => $propertyValue) {
            $property = $this->getReflectedProperty(
                $this->getReflectionUtility()->getClassReflection($this),
                $propertyName
            );
            $property->setAccessible(true);
            $property->setValue($this, $propertyValue);
        }
        return ($export === $this->export());
    }

    private function getReflectedProperty(ReflectionClass $reflection, string $propertyName): ReflectionProperty
    {
        try {
            return $reflection->getProperty($propertyName);
        } catch (ReflectionException $e) {
            $this->log(
                $this::PROP_NOT_DEFINED_IN_CLASS,
                $this->getType(),
                $propertyName
            );
        }
        if ($reflection->getParentClass() === false) {
            $this->log(
                $this::PROP_NOT_DEFINED_IN_PARENT,
                $this->getType(),
                $propertyName
            );
            try {
                return new ReflectionProperty((object)[$propertyName => null], $propertyName);
            } catch (ReflectionException $e) {
                $this->log(
                    $this::MOCK_STD_FAILED,
                    $this->getType(),
                    $propertyName
                );
                die();
            }
        }
        return $this->getReflectedProperty($reflection->getParentClass(), $propertyName);
    }

    private function getReflectionUtility(): ReflectionUtilityInterface
    {
        return $this->reflectionUtility;
    }

    public function export(): array
    {
        return $this->getReflectionUtility()->getClassPropertyValues($this);
    }

}
