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
        $response->switchState();
        $response->addRequest($this->getRouter()->getRequest());
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

    private function getStandardResponse(): StandardResponse
    {
        return new StandardResponse(
            new StandardStorable(
                'ResponseName',
                'ResponseLocation',
                'ResponseContainer'
            ),
            new StandardSwitchable()
        );
    }

    public function testGetResponsesReturnsArrayOfResponsesThatRespondToAssignedRequest(): void
    {
        $response = $this->getStandardResponse();
        $response->switchState();
        // Create response that is assigned the Routers request
        $response->addRequest($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($response);
        // Create response that is NOT assigned the Routers request
        $this->getRouter()->getCrud()->create($this->getStandardResponse());
        foreach ($this->getRouter()->getResponses($response->getLocation(), $response->getContainer()) as $response) {
            $this->assertTrue(
                $response->respondsToRequest($this->getRouter()->getRequest()),
                'getResponses() returned an array containing responses that are NOT assigned the Router\'s assigned request.'
            );
        }
    }

    public function testGetResponsesReturnsArrayOfResponsesWhoseStateIsTrue(): void
    {
        $response = $this->getStandardResponse();
        $response->addRequest($this->getRouter()->getRequest());
        $response->switchState();
        $this->getRouter()->getCrud()->create($response);
        // Create response that is assigned the Routers request and whose state is false
        $disabledResponse = $this->getStandardResponse();
        $disabledResponse->addRequest($this->getRouter()->getRequest());
        $this->getRouter()->getCrud()->create($disabledResponse);
        foreach ($this->getRouter()->getResponses($response->getLocation(), $response->getContainer()) as $response) {
            $this->assertTrue(
                $response->getState(),
                'getResponse() returned array containing responses whose state is false.'
            );
        }
    }

    protected function setRouterParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getRouter());
        $this->setSwitchableComponentParentTestInstances();
    }

}
