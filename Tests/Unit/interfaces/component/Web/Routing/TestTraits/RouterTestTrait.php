<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use roady\classes\component\Web\Routing\Response as CoreResponse;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Crud\ComponentCrud;
use roady\interfaces\component\Web\Routing\Request;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\interfaces\component\Web\Routing\Router as RouterInterface;

trait RouterTestTrait
{

    private RouterInterface $router;

    public function testGetResponseContainerReturnsStringWhoseValueMatchesTheResponseInterfacesResponseContainerConstant(): void
    {
        $this->assertEquals(
            ResponseInterface::RESPONSE_CONTAINER,
            $this->getRouter()->getResponseContainer()
        );
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }

    public function testRequestIsSetPostInstantiation(): void
    {
        $this->assertTrue(
            $this->objectInstanceIsSetAndCorrectType(
                'request',
                Request::class
            )
        );
    }

    /**
     * @return array<string, string>
     */
    private function classImplements(string|object $class): array {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
    }

    private function objectInstanceIsSetAndCorrectType(string $propertyName, string $type): bool
    {
        return (
        in_array(
            $type,
            $this->classImplements(
                $this->getRouter()->export()[$propertyName]
            )
        )
        );
    }

    public function testCrudIsSetPostInstantiation(): void
    {
        $this->assertTrue(
            $this->objectInstanceIsSetAndCorrectType(
                'crud',
                ComponentCrud::class
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
            $ls = scandir($dir);
            $contents = (is_array($ls) ? $ls : []);
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
                in_array('roady\interfaces\component\Web\Routing\Response', $this->classImplements($response)),
                'The response data was corrupted between the time it was created via the Crud and returned by the Router. Check the Storage Driver being used by the Crud'
            );
        }
    }

    private function getStandardResponse(string $name = '', string $location = '', string $container = ''): CoreResponse
    {
        return new CoreResponse(
            new CoreStorable(
                (empty($name) === true ? 'RouterTestTraitStandardResponseName' : $name),
                (empty($location) === true ? 'RouterTestTraitStandardResponseLocation' : $location),
                (empty($container) === true ? 'RouterTestTraitStandardResponseContainer' : $container)
            ),
            new CoreSwitchable()
        );
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
