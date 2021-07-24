<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use roady\abstractions\component\Web\App as AppBase;
use roady\classes\component\Component as CoreComponent;
use roady\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\App as CoreApp;
use roady\classes\component\Web\Routing\Request as CoreRequest;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use RuntimeException;

trait AppTestTrait
{

    protected string $expectedAppContainer = 'APP';
    private AppInterface $app;
    private RequestInterface $mockRequest;

    public function testAPP_CONTAINERConstantIsSetToStringAPP(): void
    {
        $this->assertEquals($this->expectedAppContainer, AppBase::APP_CONTAINER);
        $this->assertEquals($this->expectedAppContainer, CoreApp::APP_CONTAINER);
        $this->assertEquals($this->expectedAppContainer, $this->getApp()::APP_CONTAINER);
    }

    protected function getApp(): AppInterface
    {
        return $this->app;
    }

    protected function setApp(AppInterface $app): void
    {
        $this->app = $app;
    }

    public function testGetAppDomainReturnsRequestSuppliedToConstructorOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getMockRequest(),
            $this->getApp()->getAppDomain()
        );
    }

    protected function getMockRequest(): RequestInterface
    {
        if (!isset($this->mockRequest)) {
            $this->mockRequest = new CoreRequest(
                new CoreStorable(
                    "MockRequest",
                    "Temp",
                    "Temp"
                ),
                new CoreSwitchable()
            );
            $this->mockRequest->import(['url' => $this->getRandomUrl()]);
        }
        return $this->mockRequest;
    }

    private function getRandomUrl(): string
    {
        $urls = [
            // Well formed urls
            'http://192.168.33.10:80',
            'http://192.168.33.10:80/index.php',
            'http://192.168.33.10:80/index.php?foo=bar&baz=bazzer',
            'http://dcms.dev',
            'http://dcms.dev/index.php',
            'http://dcms.dev/index.php?foo=bar',
            // Malformed urls
            '//192.168.33.10:80',
            'http:192.168.33.10:80/index.php',
            '/index.php?foo=bar&baz=bazzer',
            '/',
            './',
            '../',
            'dcms.dev/index.php',
            'dcms.dev',
            'dcms',
        ];
        return $urls[array_rand($urls)];
    }

    public function testGetContainerReturnsValueOfAPP_CONTAINERConstant(): void
    {
        $this->assertEquals($this->getApp()::APP_CONTAINER, $this->getApp()->getContainer());
        $this->assertEquals(
            $this->getApp()::APP_CONTAINER,
            $this->getApp()->export()['storable']->getContainer()
        );
    }

    public function testDeriveAppNameLocationReturnsAlphaNumericStringFormOfValueReturnedByParsingSpecifiedRequestsUrlToGetHostOrStringDEFAULTIfUrlHostCantBeDetermined(): void
    {
        $mockRequest = $this->getMockRequest();
        $mockRequest->import(['url' => $this->getRandomUrl()]);
        $host = parse_url($mockRequest->getUrl(), PHP_URL_HOST);
        $port = parse_url($mockRequest->getUrl(), PHP_URL_PORT);
        $hostPort = $host . strval($port);
        $expectedNameLocation = preg_replace(
            "/[^A-Za-z0-9]/",
            '',
            $hostPort
        );
        if (empty($expectedNameLocation)) {
            $expectedNameLocation = 'DEFAULT';
        }
        $this->assertEquals(
            $expectedNameLocation,
            $this->getApp()::deriveAppLocationFromRequest($this->getMockRequest())
        );
    }

    public function testLocationWasSetUsingDeriveAppNameLocationFromRequestMethod(): void
    {
        $expectedNameLocation = CoreApp::deriveAppLocationFromRequest($this->getMockRequest());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getLocation());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getLocation());
    }

    public function testNameWasSetUsingDeriveAppNameLocationFromRequestMethodIfNameWasNotSpecified(): void
    {
        $expectedNameLocation = CoreApp::deriveAppLocationFromRequest($this->getMockRequest());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getName());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getName());
    }

    public function testNameWasSetToSpecifiedNameIfNameWasSpecified(): void
    {
        $expectedName = "HelloWorld";
        $namedApp = new CoreApp($this->getMockRequest(), new CoreSwitchable(), $expectedName);
        $this->assertEquals($expectedName, $namedApp->getName());
        $this->assertEquals($expectedName, $namedApp->export()['storable']->getName());
    }


    private function purgeAppStorage(): void
    {
        $installedApps = $this->getMockCrud()->readAll(
            CoreApp::deriveAppLocationFromRequest($this->getMockRequest()),
            CoreApp::APP_CONTAINER
        );
        foreach ($installedApps as $storable) {
            $this->getMockCrud()->delete($storable);
        }
    }

    protected function getMockCrud(): CoreComponentCrud
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'TEMP', 'TEMP'),
            new CoreSwitchable(),
            new JsonStorageDriver(
                new CoreStorable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new CoreSwitchable()
            )
        );
    }










    protected function setAppParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getApp());
        $this->setSwitchableComponentParentTestInstances();
    }

}
