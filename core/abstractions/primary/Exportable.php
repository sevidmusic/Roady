<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\classes\utility\ReflectionUtility;
use DarlingCms\interfaces\primary\Exportable as ExportableInterface;
use ReflectionClass;
use ReflectionException;

abstract class Exportable extends Classifiable implements ExportableInterface
{
    /** @noinspection PhpUnused */
    public function export(): array
    {
        $r = new ReflectionUtility();
        return $r->getClassPropertyValues($this);
    }

    /** @noinspection PhpUnused */
    public function import(array $export): bool
    {
        $reflection = $this->getReflection();
        foreach ($export as $propertyName => $propertyValue) {
            $property = $this->getReflectedProperty($reflection, $propertyName);
            $property->setAccessible(true);
            $property->setValue($this, $propertyValue);
        }
        return true;
    }

    private function getReflection()
    {
        try {
            return new ReflectionClass($this);
        } catch (ReflectionException $e) {
            error_log(printf('Exportable error: Exportable type "%s" was unable to reflect itself in preparation for import().', $this->getType()));
            return false;
        }
    }

    private function getReflectedProperty(ReflectionClass $reflection, string $propertyName)
    {
        try {
            return $reflection->getProperty($propertyName);
        } catch (ReflectionException $e) {
            error_log(printf('Exportable error: Exportable type "%s" was unable to get property  "%s" in preparation for import().', $this->getType(), $propertyName));
            return false;
        }
    }
}
