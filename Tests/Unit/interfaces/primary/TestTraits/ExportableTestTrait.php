<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Exportable;
use UnitTests\classes\utility\ReflectionUtilityTest;
use UnitTests\TestTraits\ArrayTester;
use UnitTests\TestTraits\ReflectionUtilityInstance;

trait ExportableTestTrait
{

    use ArrayTester;
    use ReflectionUtilityInstance;

    private $exportable;

    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues()
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable()),
            $this->getExportable()->export()
        );
    }

    protected function getExportable(): Exportable
    {
        return $this->exportable;
    }

    protected function setExportable(Exportable $exportable)
    {
        $this->exportable = $exportable;
    }

    public function testPropertiesMatchImportedPropertiesPostImport()
    {
        $originalValues = $this->getReflectionUtility()->getClassPropertyValues($this->getExportable());
        $this->getExportable()->import(['reflectionUtility' => new ReflectionUtilityTest()]);
        $this->assertNotEquals(
            $originalValues,
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable())
        );
    }

}
