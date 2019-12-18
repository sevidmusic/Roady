<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Exportable as ExportableInterface;

abstract class Exportable implements ExportableInterface  {
    public function export():array {
        $r = new \DarlingCms\classes\utility\ReflectionUtility();
        return $r->getClassPropertyValues($this);
    }

    public function import(array $export):bool {
        $reflection = new \ReflectionClass($this);
        foreach($export as $propertyName => $propertyValue) {
            $property = $reflection->getProperty($propertyName);
            $property->setAccessible(true);
            $property->setValue($this, $propertyValue);
        }
        return true;
    }
}
