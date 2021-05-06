<?php

namespace UnitTests\interfaces\utility\TestTraits;

use DarlingDataManagementSystem\interfaces\utility\AppBuilder as AppBuilderInterface;
use DarlingDataManagementSystem\classes\utility\AppBuilder;

trait AppBuilderTestTrait
{

    public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedAppsNameMatchesTheSpecifiedAppName(): void
    {
        $appName = 'TestApp' . strval(rand(0, PHP_INT_MAX));
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, 'http://localhost:8080');
        $this->assertEquals(
            $appName,
            $appComponentsFactory->getApp()->getName()
        );
    }

}
