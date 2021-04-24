<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingDataManagementSystem\interfaces\primary\Exportable as ExportableInterface;
use UnitTests\classes\utility\ReflectionUtilityTest as ReflectionUtilityTestInterface;
use UnitTests\TestTraits\ReflectionUtilityInstance;

trait ExportableTestTrait
{

    use ReflectionUtilityInstance;

    private ExportableInterface $exportable;

    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues()
    {
        $this->assertEquals(
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable()),
            $this->getExportable()->export()
        );
    }

    protected function getExportable(): ExportableInterface
    {
        return $this->exportable;
    }

    protected function setExportable(ExportableInterface $exportable)
    {
        $this->exportable = $exportable;
    }

    public function testPropertiesMatchImportedPropertiesPostImport()
    {
        $originalValues = $this->getReflectionUtility()->getClassPropertyValues($this->getExportable());
        $this->getExportable()->import(['reflectionUtility' => new ReflectionUtilityTestInterface()]);
        $this->assertNotEquals(
            $originalValues,
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable())
        );
    }

}
