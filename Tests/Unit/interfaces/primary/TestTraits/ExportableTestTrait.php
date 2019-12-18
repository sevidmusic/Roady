<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\classes\utility\ReflectionUtility;
use UnitTests\TestUtilities\ArrayTestUtility;
trait ExportableTestTrait {

    protected $reflectionUtility;
    protected static $arrayTestutility;
    protected $exportable;

    /**
     * @before
     */
    public function initializeUtilities() {
        $this->arrayTestUtility = new ArrayTestUtility();
        $this->reflectionUtility = new ReflectionUtility();
    }
    public function testTestIsRunning() {
        $this->assertTrue(true);
    }

    public function testExportReturnsArrayWhoseValuesAreInstancesPropertyValues() {
        $this->arrayTestUtility->arraysAreEqual(
            $this->reflectionUtility->getClassPropertyValues($this->exportable),
            $this->exportable->export()
        );
    }

}
