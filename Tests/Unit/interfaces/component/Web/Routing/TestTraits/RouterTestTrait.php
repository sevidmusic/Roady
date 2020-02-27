<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\classes\component\Web\Routing\Response as StandardResponse;
use DarlingCms\classes\primary\Storable as StandardStorable;
use DarlingCms\classes\primary\Switchable as StandardSwitchable;
use DarlingCms\interfaces\component\Web\Routing\Router;

trait RouterTestTrait
{

    private $router;

    public function testRequestIsSetPostInstantiation(): void
    {
        $this->assertTrue(
            $this->objectInstanceIsSetAndCorrectType(
                'request',
                'DarlingCms\interfaces\component\Web\Routing\Request'
            )
        );
    }

    private function objectInstanceIsSetAndCorrectType(string $propertyName, string $type): bool
    {
        return (
        in_array(
            $type,
            class_implements(
                $this->getRouter()->export()[$propertyName]
            )
        )
        );
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function setRouter(Router $router): void
    {
        $this->router = $router;
    }

    public function testCrudIsSetPostInstantiation(): void
    {
        $this->assertTrue(
            $this->objectInstanceIsSetAndCorrectType(
                'crud',
                'DarlingCms\interfaces\component\Crud\ComponentCrud'
            )
        );
    }

    public function tearDown(): void
    {
        $this->removeDirectory(
            $this->getRouter()->export()['crud']->export()['storageDriver']->getStorageDirectoryPath()
        );
    }

    private function removeDirectory(string $dir): void
    {
        if (is_dir($dir)) {
            $contents = scandir($dir);
            foreach ($contents as $item) {
                if ($item != "." && $item != "..") {
                    $itemPath = $dir . DIRECTORY_SEPARATOR . $item;
                    (is_dir($itemPath) === true && is_link($itemPath) === false)
                        ? $this->removeDirectory($itemPath)
                        : unlink($itemPath);
                }
            }
            rmdir($dir);
        }
    }

    public function testGetCrudReturnsAssignedCrud(): void
    {
        $this->assertEquals(
            $this->getRouter()->export()['crud']->getUniqueId(),
            $this->getRouter()->getCrud()->getUniqueId()
        );
    }

    public function testGetRequestReturnsAssignedRequest(): void
    {
        $this->assertEquals(
            $this->getRouter()->export()['request']->getUniqueId(),
            $this->getRouter()->getRequest()->getUniqueId()
        );
    }

    public function testGetResponsesReturnsArrayOfResponsesThatAreNotCorrupted(): void
    {
        $response = $this->getStandardResponse();
        $response->addRequestStorageInfo($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($response);
        $this->assertFalse(
            empty(
            $this->getRouter()->getResponses(
                $response->getLocation(),
                $response->getContainer()
            )
            ),
            'Response array is empty, response data is corrupted. Check the Storage Driver being used by the Crud.'
        );
        foreach ($this->getRouter()->getResponses($response->getLocation(), $response->getContainer()) as $response) {
            $this->assertTrue(
                in_array('DarlingCms\interfaces\component\Web\Routing\Response', class_implements($response)),
                'The response data was corrupted between the time it was created via the Crud and returned by the Router. Check the Storage Driver being used by the Crud'
            );
        }
    }

    private function getStandardResponse(string $name = '', string $location = '', string $container = ''): StandardResponse
    {
        $response = new StandardResponse(
            new StandardStorable(
                (empty($name) === true ? 'RouterTestTraitStandardResponseName' : $name),
                (empty($location) === true ? 'RouterTestTraitStandardResponseLocation' : $location),
                (empty($container) === true ? 'RouterTestTraitStandardResponseContainer' : $container)
            ),
            new StandardSwitchable()
        );
        return $response;
    }

    public function testGetResponsesReturnsArrayOfResponsesThatRespondToAssignedRequest(): void
    {
        $response = $this->getStandardResponse();
        $this->getRouter()->getCrud()->create($this->getRouter()->getRequest());
        $response->addRequestStorageInfo($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($response);
        $this->getRouter()->getCrud()->create($this->getStandardResponse());
        foreach ($this->getRouter()->getResponses($response->getLocation(), $response->getContainer()) as $response) {
            $this->assertTrue(
                $response->respondsToRequest($this->getRouter()->getRequest(), $this->getRouter()->getCrud()),
                'getResponses() returned an array containing responses that are NOT assigned the Router\'s assigned request.'
            );
        }
    }

    public function testGetResponsesReturnsArrayOfResponsesWhoseStateIsTrue(): void
    {
        $enabledResponse = $this->getStandardResponse('EnabledResponse');
        $enabledResponse->addRequestStorageInfo($this->getRouter()->getRequest());
        $disabledResponse = $this->getStandardResponse('DisabledResponse');
        $disabledResponse->addRequestStorageInfo($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($enabledResponse);
        $this->getRouter()->getCrud()->create($disabledResponse);
        $this->getRouter()->getCrud()->create($this->getRouter()->getRequest());
        foreach ($this->getRouter()->getResponses($enabledResponse->getLocation(), $enabledResponse->getContainer()) as $enabledResponse) {
            $this->assertTrue(
                $enabledResponse->getState(),
                'getResponses() returned an array containing responses that are NOT assigned the Router\'s assigned request.'
            );
        }
    }

    public function testGetResponsesReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnSwitchableComponentOff($this->getRouter());
        $this->assertEmpty(
            $this->getRouter()->getResponses(
                $this->getStandardResponse()->getLocation(),
                $this->getStandardResponse()->getContainer()
            )
        );
    }

    protected function setRouterParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getRouter());
        $this->setSwitchableComponentParentTestInstances();
    }

}