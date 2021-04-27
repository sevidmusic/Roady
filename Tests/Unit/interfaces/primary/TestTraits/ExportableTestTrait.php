<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingDataManagementSystem\interfaces\primary\Exportable as ExportableInterface;
use UnitTests\classes\utility\ReflectionUtilityTest as ReflectionUtilityTestInterface;
use UnitTests\TestTraits\ReflectionUtilityInstance;

trait ExportableTestTrait
{

    use ReflectionUtilityInstance;

    private ExportableInterface $exportable;

    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues(): void
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

    protected function setExportable(ExportableInterface $exportable): void
    {
        $this->exportable = $exportable;
    }

    public function testPropertiesMatchImportedPropertiesPostImport(): void
    {
        $originalValues = $this->getReflectionUtility()->getClassPropertyValues($this->getExportable());
        $this->getExportable()->import(['reflectionUtility' => new ReflectionUtilityTestInterface()]);
        $this->assertNotEquals(
            $originalValues,
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable())
        );
    }

}
