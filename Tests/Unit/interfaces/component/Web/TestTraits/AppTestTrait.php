<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use DarlingCms\interfaces\component\Web\App;
use DarlingCms\abstractions\component\Web\App as AbstractApp;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

trait AppTestTrait
{

    private $app;
    private $mockRequest;

    protected function setAppParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getApp());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getApp(): App
    {
        return $this->app;
    }

    protected function setApp(App $app): void
    {
        $this->app = $app;
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

    private function getMockRequest(): Request
    {
        if(!isset($this->mockRequest)) {
            $this->mockRequest = new CoreRequest(new Storable("MockRequest", "Temp", "Temp"), new Switchable());
            $this->mockRequest->import(['url' => $this->getRandomUrl()]);
        }
        return $this->mockRequest;
    }

    public function testAPP_CONTAINERConstantIsSetToStringAPP(): void
    {
        $this->assertEquals("APP", AbstractApp::APP_CONTAINER);
        $this->assertEquals("APP", CoreApp::APP_CONTAINER);
        $this->assertEquals("APP", $this->getApp()::APP_CONTAINER);
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
        if(empty($expectedNameLocation)) {
            $expectedNameLocation = 'DEFAULT';
        }
        $this->assertEquals(
            $expectedNameLocation,
            $this->getApp()::deriveNameLocationFromRequest($this->getMockRequest())
        );
    }

}
