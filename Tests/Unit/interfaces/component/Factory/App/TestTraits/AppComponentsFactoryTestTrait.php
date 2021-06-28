<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

trait AppComponentsFactoryTestTrait
{

    private AppComponentsFactoryInterface $appComponentsFactory;
    private RequestInterface $testDomain;

    public function testAppComponentsFactoryImplementsOutputComponentFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                OutputComponentFactoryInterface::class
            )
        );
    }

    public function appComponentsFactoryImplementsExpectedInterface(string $expectedInterface): bool
    {
        return $this->isProperImplementation(
            $expectedInterface,
            $this->getAppComponentsFactory()
        );
    }

    protected function getAppComponentsFactory(): AppComponentsFactoryInterface
    {
        return $this->appComponentsFactory;
    }

    protected function setAppComponentsFactory(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        $this->appComponentsFactory = $appComponentsFactory;
    }

    public function testAppComponentsFactoryImplementsResponseFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                ResponseFactoryInterface::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsStoredComponentFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                StoredComponentFactoryInterface::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsStandardUITemplateFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                StandardUITemplateFactoryInterface::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsRequestFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                RequestFactoryInterface::class
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayWithExactlyThreeValues(): void
    {
        $this->assertEquals(
            3,
            count(
                $this->appComponentsFactory::buildConstructorArgs(
                    $this->getTestDomain()
                )
            )
        );
    }

    private function getTestDomain(): RequestInterface
    {
        if (!isset($this->testDomain) === true) {
            $this->testDomain = new CoreRequest(
                $this->getAppComponentsFactory()->getPrimaryFactory()->buildStorable(
                    'TestDomain',
                    'TestRequests'
                ),
                $this->getAppComponentsFactory()->getPrimaryFactory()->buildSwitchable()
            );
        }
        return $this->testDomain;
    }

    public function testBuildConstructorArgsReturnsAnArrayOfObjects(): void
    {
        foreach (
            $this->appComponentsFactory::buildConstructorArgs(
                $this->getTestDomain()
            )
            as $value
        ) {
            $this->assertTrue(is_object($value));
        }
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAPrimaryFactoryImplementationInstanceAtIndex0(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                PrimaryFactoryInterface::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[0]
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAPrimaryFactoryImplementationInstanceAtIndex0WhoseAssignedAppMatchesTheSpecifiedAppIfAnAppInstanceIsSpecified(): void
    {
        $request = new CoreRequest(
            new CoreStorable(
                'AppDomain',
                'Requests',
                'TestComponents'
            ),
            new CoreSwitchable()
        );
        $app = new CoreApp($request, new CoreSwitchable());
        $ctor_args = $this->getAppComponentsFactory()::buildConstructorArgs(
           $this->getTestDomain(),
           $app
        );
        $this->assertEquals($app, $ctor_args[0]->export()['app']);
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAComponentCrudImplementationInstanceAtIndex1(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                ComponentCrudInterface::class,
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
                StoredComponentRegistryInterface::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[2]
            )
        );
    }

    public function testBuildDomainReturnsRequestWhoseNameMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            CoreApp::deriveAppLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getName()
        );
    }

    public function testBuildDomainReturnsRequestWhoseLocationMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            CoreApp::deriveAppLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getLocation()
        );
    }

    public function testBuildDomainReturnsRequestWhoseContainerMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            CoreApp::deriveAppLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getContainer()
        );
    }

    public function testBuildDomainReturnsRequestWhoseUrlMatchesSuppliedUrl(): void
    {
        $this->assertEquals(
            $this->getTestDomain()->getUrl(),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getUrl()
        );
    }

    public function testGetStoredComponentRegistryReturnsAStoredComponentRegistryWhoseAcceptedImplementationIsTheComponentInterface(): void
    {
        $this->assertEquals(
            ComponentInterface::class,
            $this->getAppComponentsFactory()->getStoredComponentRegistry()->export()['acceptedImplementation']
        );
    }

    public function testBuildLogReturnsExpectedString(): void
    {
        $this->assertEquals(
            $this->expectedBuildLog(),
            $this->getAppComponentsFactory()->buildLog()
        );
    }

    /** @noinspection DuplicatedCode */
    private function expectedBuildLog(): string
    {
        $buildLog = "";
        foreach (
            $this->getAppComponentsFactory()->getStoredComponentRegistry()->getRegisteredComponents()
            as
            $storable
        ) {
            $message = sprintf(
                '%sBuilt %s:%s    Name: %s%s    Container: %s%s    Location: %s%s    Type: %s%s    UniqueId: %s%s',
                PHP_EOL,
                $storable->getType(),
                PHP_EOL,
                "\033[42m" . $storable->getName() . "\033[0m",
                PHP_EOL,
                "\033[1;32m" . $storable->getContainer() . "\033[0m",
                PHP_EOL,
                "\033[44m" . $storable->getLocation() . "\033[0m",
                PHP_EOL,
                "\033[1;34m" . $storable->getType() . "\033[0m",
                PHP_EOL,
                "\033[46m" . $storable->getUniqueId() . "\033[0m",
                PHP_EOL
            );
            $buildLog .= $message;
        }
        return $buildLog;
    }

    public function testBuildLogEchosBuildLogIfSHOW_LOGFlagIsSupplied(): void
    {
        $this->getAppComponentsFactory()->buildLog($this->getAppComponentsFactory()::SHOW_LOG);
        $this->expectOutputString($this->expectedBuildLog());
    }

    public function testBuildLogSavesBuildLogToExpectedLocationAndProducesExpectedOutputIfSAVE_LOGFlagIsSupplied(): void
    {
        $this->getAppComponentsFactory()->buildLog(
            $this->getAppComponentsFactory()::SAVE_LOG
        );
        $this->expectOutputString($this->expectedSAVE_LOGOutput());
        $this->assertTrue(file_exists($this->expectedBuildLogPath()));
    }

    private function expectedSAVE_LOGOutput(): string
    {
        return sprintf(
            '%sSaved build log to: %s',
            PHP_EOL,
            "\033[1;34m" . $this->expectedBuildLogPath() . "\033[0m" . PHP_EOL
        );
    }

    private function expectedBuildLogPath(): string
    {
        return str_replace(
            'Tests/Unit/interfaces/component/Factory/App/TestTraits',
            'Apps' .
            DIRECTORY_SEPARATOR .
            '.buildLogs' .
            DIRECTORY_SEPARATOR .
            $this->getAppComponentsFactory()->getPrimaryFactory()->export()['app']->getName(),
            __DIR__
        );

    }

    public function getOutputComponentFactory(): OutputComponentFactoryInterface
    {
        return $this->getAppComponentsFactory();
    }

    public function getStandardUITemplateFactory(): StandardUITemplateFactoryInterface
    {
        return $this->getAppComponentsFactory();
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->getAppComponentsFactory();
    }

    public function getResponseFactory(): ResponseFactoryInterface
    {
        return $this->getAppComponentsFactory();
    }

    protected function setAppComponentsFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getAppComponentsFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    /**
     * @return array{0: PrimaryFactoryInterface, 1: ComponentCrudInterface, 2: StoredComponentRegistryInterface}
     */
    protected function getTestInstanceArgs(): array
    {
        return [
            $this->getMockPrimaryFactory(),
            $this->getMockCrud(),
            $this->getMockStoredComponentRegistry()
        ];
    }
}
