<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\classes\utility\ReflectionUtility;

trait ExportableTestTrait {

    protected static $reflectionUtility;

    public function testTestIsRunning() {
        $this->assertTrue(true);
    }
}
