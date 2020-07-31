<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use DarlingDataManagementSystem\abstractions\component\Web\App as AbstractApp;
use DarlingDataManagementSystem\classes\component\Component;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\Standard as StandardStorageDriver;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\interfaces\component\Web\App;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use RuntimeException;

trait AppTestTrait
{

    private $app;
    private $mockRequest;

    public function testAPP_CONTAINERConstantIsSetToStringAPP(): void
    {
        $this->assertEquals("APP", AbstractApp::APP_CONTAINER);
        $this->assertEquals("APP", CoreApp::APP_CONTAINER);
        $this->assertEquals("APP", $this->getApp()::APP_CONTAINER);
    }

    protected function getApp(): App
    {
        return $this->app;
    }

    protected function setApp(App $app): void
    {
        $this->app = $app;
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
        $expectedNameLocation = preg_replace(
            "/[^A-Za-z0-9]/",
            '',
            parse_url($this->getMockRequest()->getUrl(), PHP_URL_HOST)
        );
        if (empty($expectedNameLocation)) {
            $expectedNameLocation = 'DEFAULT';
        }
        $this->assertEquals(
            $expectedNameLocation,
            $this->getApp()::deriveNameLocationFromRequest($this->getMockRequest())
        );
    }

    protected function getMockRequest(): Request
    {
        if (!isset($this->mockRequest)) {
            $this->mockRequest = new CoreRequest(new Storable("MockRequest", "Temp", "Temp"), new Switchable());
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

    public function testNameAndLocationWereSetUsingDeriveAppNameLocationFromRequestMethod(): void
    {
        $expectedNameLocation = CoreApp::deriveNameLocationFromRequest($this->getMockRequest());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getName());
        $this->assertEquals($expectedNameLocation, $this->getApp()->getLocation());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getName());
        $this->assertEquals($expectedNameLocation, $this->getApp()->export()['storable']->getLocation());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnStaticCallIfAppIsNotInstalled(): void
    {
        $this->purgeAppStorage();
        $this->expectException(RuntimeException::class);
        CoreApp::getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    private function purgeAppStorage(): void
    {
        $installedApps = $this->getMockCrud()->readAll(
            CoreApp::deriveNameLocationFromRequest($this->getMockRequest()),
            CoreApp::APP_CONTAINER
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
            new StandardStorageDriver(
                new Storable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new Switchable()
            )
        );
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnStaticCallIfAppDataIsCorrupted(): void
    {
        $this->purgeAppStorage();
        $component = new Component(
            new Storable(
                CoreApp::deriveNameLocationFromRequest($this->getMockRequest()),
                CoreApp::deriveNameLocationFromRequest($this->getMockRequest()),
                CoreApp::APP_CONTAINER
            )
        );
        $this->getMockCrud()->create($component);
        $this->expectException(RuntimeException::class);
        CoreApp::getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnStaticCallIfAppStateIsFalse(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        if ($app->getState() === true) {
            $app->switchState();
        }
        $this->getMockCrud()->create($app);
        $this->expectException(RuntimeException::class);
        CoreApp::getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnInstanceCallIfAppIsNotInstalled(): void
    {
        $this->purgeAppStorage();
        $this->expectException(RuntimeException::class);
        $this->getApp()->getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnInstanceCallIfAppDataIsCorrupted(): void
    {
        $this->purgeAppStorage();
        $component = new Component(
            new Storable(
                $this->getApp()->deriveNameLocationFromRequest($this->getMockRequest()),
                $this->getApp()->deriveNameLocationFromRequest($this->getMockRequest()),
                $this->getApp()::APP_CONTAINER
            )
        );
        $this->getMockCrud()->create($component);
        $this->expectException(RuntimeException::class);
        $this->getApp()->getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnInstanceCallIfAppStateIsFalse(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        if ($app->getState() === true) {
            $app->switchState();
        }
        $this->getMockCrud()->create($app);
        $this->expectException(RuntimeException::class);
        $this->getApp()->getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnStaticCallIfAnAppCantBeFoundInStorageWhoseNameMatchesTheValueReturnedByPassingSuppliedRequestToAppDeriveNameLocationFromRequestMethod(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        $app->import(['storable' => new Storable('BadImportedName', $app->getLocation(), $app->getContainer())]);
        $this->getMockCrud()->create($app);
        $this->expectException(RuntimeException::class);
        CoreApp::getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppReturnsAppOnStaticCallWhoseNameAndLocationMatchTheValueReturnedByPassingSuppliedRequestToAppDeriveNameLocationFromRequestMethodAndWhoseContainerMatchesTheValueOfTheAppAPP_CONTAINERConstant(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        $this->getMockCrud()->create($app);
        $requestedApp = CoreApp::getRequestedApp($this->getMockRequest(), $this->getMockCrud());
        $this->assertEquals(CoreApp::deriveNameLocationFromRequest($this->getMockRequest()), $requestedApp->getName());
        $this->assertEquals(CoreApp::deriveNameLocationFromRequest($this->getMockRequest()), $requestedApp->getLocation());
        $this->assertEquals(CoreApp::APP_CONTAINER, $requestedApp->getContainer());
    }

    public function testGetRequestedAppThrowsRuntimeExceptionOnInstanceCallIfAnAppCantBeFoundInStorageWhoseNameMatchesTheValueReturnedByPassingSuppliedRequestToAppDeriveNameLocationFromRequestMethod(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        $app->import(['storable' => new Storable('BadImportedName', $app->getLocation(), $app->getContainer())]);
        $this->getMockCrud()->create($app);
        $this->expectException(RuntimeException::class);
        $this->getApp()->getRequestedApp($this->getMockRequest(), $this->getMockCrud());
    }

    public function testGetRequestedAppReturnsAppOnInstanceCallWhoseNameAndLocationMatchTheValueReturnedByPassingSuppliedRequestToAppDeriveNameLocationFromRequestMethodAndWhoseContainerMatchesTheValueOfTheAppAPP_CONTAINERConstant(): void
    {
        $this->purgeAppStorage();
        $app = new CoreApp($this->getMockRequest(), new Switchable());
        $this->getMockCrud()->create($app);
        $requestedApp = $this->getApp()->getRequestedApp($this->getMockRequest(), $this->getMockCrud());
        $this->assertEquals($this->getApp()->deriveNameLocationFromRequest($this->getMockRequest()), $requestedApp->getName());
        $this->assertEquals($this->getApp()->deriveNameLocationFromRequest($this->getMockRequest()), $requestedApp->getLocation());
        $this->assertEquals($this->getApp()::APP_CONTAINER, $requestedApp->getContainer());
    }

    protected function setAppParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getApp());
        $this->setSwitchableComponentParentTestInstances();
    }

}
