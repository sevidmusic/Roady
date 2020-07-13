<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory;
use DarlingCms\interfaces\component\Factory\OutputComponentFactory;
use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\component\Web\App;

trait AppComponentsFactoryTestTrait
{

    private $appComponentsFactory;

    public function testAppComponentsFactoryImplementsOutputComponentFactoryInterface(): void
    {
        $this->getOutputComponentFactory();
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                OutputComponentFactory::class
            )
        );
    }

    public function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->getAppComponentsFactory();
    }

    public function getStandardUITemplateFactory(): StandardUITemplateFactory
    {
        return $this->getAppComponentsFactory();
    }

    public function appComponentsFactoryImplementsExpectedInterface(
        string $expectedInterface
    ): bool
    {
        return $this->isProperImplementation(
            $expectedInterface,
            $this->getAppComponentsFactory()
        );
    }

    protected function setAppComponentsFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getAppComponentsFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getAppComponentsFactory(): AppComponentsFactory
    {
        return $this->appComponentsFactory;
    }

    protected function setAppComponentsFactory(AppComponentsFactory $appComponentsFactory): void
    {
        $this->appComponentsFactory = $appComponentsFactory;
    }

    private function getTestDomain(): Request
    {
        return new CoreRequest(
            $this->getAppComponentsFactory()->getPrimaryFactory()->buildStorable(
                'TestDomain',
                'TestRequests'
            ),
            $this->getAppComponentsFactory()->getPrimaryFactory()->buildSwitchable()
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayWithExactlyThreeValues(): void {
        $this->assertEquals(
            3,
            count(
                $this->appComponentsFactory::buildConstructorArgs(
                    $this->getTestDomain()
                )
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayOfObjects(): void {
        foreach(
            $this->appComponentsFactory::buildConstructorArgs(
                $this->getTestDomain()
            )
            as $value
        )
        {
            $this->assertTrue(is_object($value));
        }
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAPrimaryFactoryImplementationInstanceAtIndex0(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                PrimaryFactory::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[0]
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAComponentCrudImplementationInstanceAtIndex1(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                ComponentCrud::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[1]
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAStoredComponentRegistryImplementationInstanceAtIndex2(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                StoredComponentRegistry::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[2]
            )
        );
    }

/*    public function testBuildDomainReturnsRequestWhoseNameMatchesExpectedAppNameLocation(): void {
        var_dump(
            App::deriveNameLocationFromRequest(
                $this->getTestDomain()
            )
        );
        $this->assertEquals(
            App::deriveNameLocationFromRequest($this->getTestDomain()).
            $this->getAppComponentsFactory()::buildDomain($this->getTestDomain()->getUrl())
        );
}*/
}
