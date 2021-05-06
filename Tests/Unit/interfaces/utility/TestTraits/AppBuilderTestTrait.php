<?php

namespace UnitTests\interfaces\utility\TestTraits;

use DarlingDataManagementSystem\interfaces\utility\AppBuilder as AppBuilderInterface;
use DarlingDataManagementSystem\classes\utility\AppBuilder;

trait AppBuilderTestTrait
{

    public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedAppsNameMatchesTheSpecifiedAppName(): void
    {
        $appName = 'TestApp' . strval(rand(0, PHP_INT_MAX));
        $domain = 'http://localhost:' . strval(rand(8000,8999));
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->assertEquals(
            $appName,
            $appComponentsFactory->getApp()->getName(),
            'The name of the App assigned to the AppComponentsFactory MUST match the name supplied to the $appName parameter.'
        );
    }

    public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedDomiansUrlMatchesTheSpecifiedDomainUrl(): void
    {
        $appName = 'TestApp' . strval(rand(0, PHP_INT_MAX));
        $domain = 'http://localhost:' . strval(rand(8000,8999));
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->assertEquals(
            $domain,
            $appComponentsFactory->getApp()->getAppDomain()->getUrl(),
            'The url assigned to the AppComponentsFactory\'s App\'s assigned domain MUST matc the url passed to the $domain parameter.'
        );
    }

    public function testGetAppsAppComponentsFactoryCreatesStoresAndReturnsAppComponentsFactoryInstance(): void
    {
        $appName = 'TestApp' . strval(rand(0, PHP_INT_MAX));
        $domain = 'http://localhost:' . strval(rand(8000,8999));
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $storedAppComponentsFactory = $appComponentsFactory->getComponentCrud()->read($appComponentsFactory);
        $this->assertEquals(
            $appComponentsFactory->getUniqueId(),
            $storedAppComponentsFactory->getUniqueId(),
            'getAppsAppComponentsFactory() MUST return a AppComponentsFactory that matches the App\'s stored AppComponentsFactory. If the App\'s stored AppComponentsFactory does not exist, getAppsAppComponentsFactory() MUST create it.'
        );
    }

}
