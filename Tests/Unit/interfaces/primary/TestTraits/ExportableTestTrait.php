<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Exportable;
use UnitTests\TestTraits\ArrayTester;
use UnitTests\TestTraits\ReflectionUtilityInstance;

trait ExportableTestTrait
{

    use ArrayTester;
    use ReflectionUtilityInstance;

    /**
     * @var Exportable
     */
    private $exportable;

    public function setExportable(Exportable $exportable)
    {
        $this->exportable = $exportable;
    }

    public function getExportable(): Exportable
    {
        return $this->exportable;
    }

    /** @noinspection PhpUnused */
    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues()
    {
        $this->getArrayTestUtility()->arraysAreEqual(
            $this->getReflectionUtility()->getClassPropertyValues($this->getExportable()),
            $this->getExportable()->export()
        );
    }

    /** @noinspection PhpUnused */
    public function testPropertiesMatchImportedPropertiesPostImport()
    {
        $preImport = $this->getReflectionUtility()->getClassPropertyValues(
            $this->getExportable()
        );
        $this->getExportable()->import($this->getExportable()->export());
        $postImport = $this->getReflectionUtility()->getClassPropertyValues(
            $this->getExportable()
        );
        $this->getArrayTestUtility()->arraysAreEqual(
            $preImport,
            $postImport
        );
    }

}
