<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\abstractions\primary\Exportable;
use DarlingCms\abstractions\primary\Exportable as AbstractExportable;
use DarlingCms\classes\utility\ReflectionUtility;
use UnitTests\TestUtilities\ArrayTestUtility;

trait ExportableTestTrait
{

    /**
     * @var ReflectionUtility
     */
    protected static $reflectionUtility;
    /**
     * @var ArrayTestUtility
     */
    protected static $arrayTestUtility;

    /**
     * @var AbstractExportable|Exportable
     */
    protected $exportable;

    /**
     * @before
     */
    public function initializeUtilities()
    {
        self::$arrayTestUtility = new ArrayTestUtility();
        self::$reflectionUtility = new ReflectionUtility();
    }

    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues()
    {
        self::$arrayTestUtility->arraysAreEqual(
            self::$reflectionUtility->getClassPropertyValues($this->exportable),
            $this->exportable->export()
        );
    }

    public function testPropertiesMatchImportedPropertiesPostImport() {
        $preImport = self::$reflectionUtility->getClassPropertyValues(
            $this->exportable
        );
        $this->exportable->import($this->exportable->export());
        $postImport = self::$reflectionUtility->getClassPropertyValues(
            $this->exportable
        );
        self::$arrayTestUtility->arraysAreEqual(
            $preImport,
            $postImport
        );
    }

}
