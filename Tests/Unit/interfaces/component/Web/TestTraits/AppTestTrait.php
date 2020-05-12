<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use DarlingCms\interfaces\component\Web\App;
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

    public function testTest(): void
    {
        var_dump($this->getMockRequest()->getUrl());
    }
}
