<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use RuntimeException;
use roady\abstractions\component\Web\App as AppBase;
use roady\classes\component\Component;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

/**
 * The AppTestTrait defines tests for implementations of the
 * roady\interfaces\component\Web\App interface.
 *
 * Test Methods:
 *
 * public function testAPP_CONTAINERConstantIsSetToStringAPP(): void
 * public function testDeriveAppLocationFromRequestReturnsAlphaNumericStringFormOfValueReturnedByParsingSpecifiedRequestsUrlToGetHostOrTheString_AppDeriveAppLocationFromRequestMethodFailedToDeriveAppLocationFromRequest_IfUrlHostCantBeDetermined(): void
 * public function testGetAppDomainReturnsRequestSuppliedToConstructorOnInstantiation(): void
 * public function testGetContainerReturnsValueOfAPP_CONTAINERConstant(): void
 * public function testLocationWasSetUsingDeriveAppNameLocationFromRequestMethod(): void
 * public function testNameWasSetToSpecifiedNameIfNameWasSpecified(): void
 * public function testNameWasSetUsingDeriveAppNameLocationFromRequestMethodIfNameWasNotSpecified(): void
 *
 * Methods:
 *
 * private function getRandomUrl(): string
 * private function purgeAppStorage(): void
 * protected function getApp(): AppInterface
 * protected function getMockCrud(): ComponentCrud
 * protected function getMockRequest(): RequestInterface
 * protected function setApp(AppInterface $app): void
 * protected function setAppParentTestInstances(): void
 *
 */
trait AppTestTrait
{

    private AppInterface $app;
    private RequestInterface $mockRequest;
    protected string $expectedAppContainer = 'APP';

    public function testAPP_CONTAINERConstantIsSetToStringAPP(): void
    {
        $this->assertEquals($this->expectedAppContainer, AppInterface::APP_CONTAINER);
        $this->assertEquals($this->expectedAppContainer, AppInterface::APP_CONTAINER);
        $this->assertEquals($this->expectedAppContainer, $this->getApp()::APP_CONTAINER);
    }

    public function testDeriveAppLocationFromRequestReturnsAlphaNumericStringFormOfValueReturnedByParsingSpecifiedRequestsUrlToGetHostOrTheString_AppDeriveAppLocationFromRequestMethodFailedToDeriveAppLocationFromRequest_IfUrlHostCantBeDetermined(): void
    {
        $mockRequest = $this->getMockRequest();
        $host = parse_url($mockRequest->getUrl(), PHP_URL_HOST);
        $port = parse_url($mockRequest->getUrl(), PHP_URL_PORT);
        $hostPort = $host . strval($port);
        $expectedLocation = preg_replace(
            "/[^A-Za-z0-9]/",
            '',
            $hostPort
        );
        if (empty($expectedLocation)) {
            $expectedLocation = 'AppDeriveAppLocationFromRequestMethodFailedToDeriveAppLocationFromRequest';
        }
        $this->assertEquals(
            $expectedLocation,
            $this->getApp()::deriveAppLocationFromRequest($mockRequest)
        );
    }

    public function testGetAppDomainReturnsRequestSuppliedToConstructorOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getMockRequest(),
            $this->getApp()->getAppDomain()
        );
    }

    public function testGetContainerReturnsValueOfAPP_CONTAINERConstant(): void
    {
        $this->assertEquals($this->getApp()::APP_CONTAINER, $this->getApp()->getContainer());
        $this->assertEquals(
            $this->getApp()::APP_CONTAINER,
            $this->getApp()->export()['storable']->getContainer()
        );
    }

    public function testLocationWasSetUsingDeriveAppNameLocationFromRequestMethod(): void
    {
        $expectedNameLocation = App::deriveAppLocationFromRequest($this->getMockRequest());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getLocation());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getLocation());
    }

    public function testNameWasSetToSpecifiedNameIfNameWasSpecified(): void
    {
        $expectedName = "HelloWorld";
        $namedApp = new App($this->getMockRequest(), new Switchable(), $expectedName);
        $this->assertEquals($expectedName, $namedApp->getName());
        $this->assertEquals($expectedName, $namedApp->export()['storable']->getName());
    }

    public function testNameWasSetUsingDeriveAppNameLocationFromRequestMethodIfNameWasNotSpecified(): void
    {
        $expectedNameLocation = App::deriveAppLocationFromRequest($this->getMockRequest());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getName());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getName());
    }

    protected function getApp(): AppInterface
    {
        return $this->app;
    }

    protected function setApp(AppInterface $app): void
    {
        $this->app = $app;
    }

    protected function getMockRequest(): RequestInterface
    {
        if (!isset($this->mockRequest)) {
            $this->mockRequest = new Request(
                new Storable(
                    "MockRequest",
                    "Temp",
                    "Temp"
                ),
                new Switchable()
            );
            $this->mockRequest->import(['url' => $this->getRandomUrl()]);
        }
        return $this->mockRequest;
    }

    private function getRandomUrl(): string
    {
        $urls = [
            // Well formed urls
            'http://000.000.00.00:00/index.php?foo=bar&baz=bazzer',
            'http://roady.dev',
            'http://roady.dev/index.php',
            'http://roady.dev/index.php?foo=bar',
            'https://roady.tech',
            // Malformed urls
            '//000.000.00.00:00',
            'http:000.000.00.00:00/index.php',
            '/index.php?foo=bar&baz=bazzer',
            '/',
            './',
            '../',
            'roady.dev/index.php',
            'roady.dev',
            'roady',
            'foo/bar/baz/bazzer',
        ];
        return $urls[array_rand($urls)];
    }
    private function purgeAppStorage(): void
    {
        $installedApps = $this->getMockCrud()->readAll(
            App::deriveAppLocationFromRequest($this->getMockRequest()),
            AppInterface::APP_CONTAINER
        );
        foreach ($installedApps as $storable) {
            $this->getMockCrud()->delete($storable);
        }
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new ComponentCrud(
            new Storable('MockCrud', 'TEMP', 'TEMP'),
            new Switchable(),
            new JsonStorageDriver(
                new Storable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new Switchable()
            )
        );
    }

    protected function setAppParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getApp());
        $this->setSwitchableComponentParentTestInstances();
    }

}
