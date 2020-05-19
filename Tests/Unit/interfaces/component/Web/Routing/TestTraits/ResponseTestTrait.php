<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate as Template;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response as StandardResponse;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Web\Routing\Response;

trait ResponseTestTrait
{

    private $response;

    public function testRespondsToRequestReturnsTrueForAssignedRequest(): void
    {
        $request = $this->getMockRequest();
        $this->getMockCrud()->create($request);
        $this->getResponse()->addRequestStorageInfo($request);
        $this->assertTrue(
            $this->getResponse()->respondsToRequest(
                $request,
                $this->getMockCrud()
            ),
            'respondsToRequest() must return true for assigned request.'
        );
    }

    protected function getMockRequest(): Request
    {
        $request = new Request(
            $this->getMockStorable(),
            $this->getMockSwitchable()
        );
        $request->import(
            [
                'url' => 'http://www.example.com/admin.php?foo=bar&baz=bazzer',
                'get' => [
                    'foo' => 'bar',
                    'baz' => 'bazzer'
                ],
                'post' => [
                    'foobarbaz'
                ]
            ]
        );
        return $request;
    }

    private function getMockStorable(): Storable
    {
        return new Storable(
            'MockName',
            'MockLocation',
            'MockContainer'
        );
    }

    private function getMockSwitchable(): Switchable
    {
        return new Switchable();
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new \DarlingCms\classes\component\Crud\ComponentCrud(
            new Storable('MockCrud', 'MockCrudLocation', 'MockCrudContainer'),
            new Switchable(),
            new Standard(
                new Storable(
                    'MockStandardStorageDriver',
                    'MockStandardStorageDriverLocation',
                    'MockStandardStorageDriverContainer'
                ),
                new Switchable()
            )
        );
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function testRespondsToRequestReturnsFalseForUnknownRequest(): void
    {
        $this->assertFalse(
            $this->getResponse()->respondsToRequest(
                $this->getMockRequest(),
                $this->getMockCrud()
            ),
            'respondsToRequest() must return false for unknown request.'
        );
    }

    public function testAddOutputComponentStorageInfoAddsSpecifiedOutputComponentsStorableInstance(): void
    {
        $initialCount = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->addOutputComponentStorageInfo(
            $this->getMockOutputComponent()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                >
                $initialCount
            ),
            'addOutput() failed to add output component\'s storable instance.'
        );
    }

    private function getMockOutputComponent(): OutputComponent
    {
        return new OutputComponent(
            $this->getMockStorable(),
            $this->getMockSwitchable(),
            new Positionable()
        );
    }

    public function testRemoveOutputComponentStorageInfoRemovesSpecifiedOutputComponentsStorableInstance(): void
    {
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->removeOutputComponentStorageInfo(
            $outputComponent->getName()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                <
                $count
            ),
            'Failed removing output component storage info by name'
        );
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->removeOutputComponentStorageInfo(
            $outputComponent->getUniqueId()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                <
                $count
            ),
            'Failed removing output component storage info by unique id'
        );
    }

    public function testGetRequestStorageInfoReturnsArrayOfStorableInstancesForAssignedRequests()
    {
        $this->turnSwitchableComponentOn($this->getResponse());
        $request = $this->getMockRequest();
        $this->getResponse()->addRequestStorageInfo($request);
        $this->assertEquals(
            [$request->export()['storable']],
            $this->getResponse()->getRequestStorageInfo(),
            'getRequestStorageInfo() did not return array of storable instances for assigned output components.'
        );
    }

    public function testGetOutputComponentStorageInfoReturnsArrayOfStorableInstancesForAssignedOutputComponents()
    {
        $this->turnSwitchableComponentOn($this->getResponse());
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $this->assertEquals(
            [$outputComponent->export()['storable']],
            $this->getResponse()->getOutputComponentStorageInfo(),
            'getOutputComponentStorageInfo() did not return array of storable instances for assigned output components.'
        );
    }

    public function testGetOutputComponentStorageInfoReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnSwitchableComponentOff($this->getResponse());
        $this->getResponse()->addOutputComponentStorageInfo(
            $this->getMockOutputComponent()
        );
        $this->assertEmpty(
            $this->getResponse()->getOutputComponentStorageInfo(),
            'getOutputComponentStorageInfo() must return an empty array if state is false.'
        );
    }

    public function testAddTemplateStorageInfoAddsSpecifiedTemplateStorableInstance(): void
    {
        $initialCount = count(
            $this->getResponse()->export()['templateStorageInfo']
        );
        $this->getResponse()->addTemplateStorageInfo($this->getMockTemplate());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['templateStorageInfo'])
                >
                $initialCount
            ),
            'addOutput() failed to add output component\'s storable instance.'
        );
    }

    private function getMockTemplate(): Template
    {
        return new Template(
            $this->getMockStorable(),
            $this->getMockSwitchable(),
            new Positionable()
        );
    }

    public function testRemoveTemplateStorageInfoRemovesSpecifiedTemplatesStorableInstance(): void
    {
        $template = $this->getMockTemplate();
        $this->getResponse()->addTemplateStorageInfo($template);
        $count = count($this->getResponse()->export()['templateStorageInfo']);
        $this->getResponse()->removeTemplateStorageInfo($template->getName());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['templateStorageInfo'])
                <
                $count
            ),
            'Failed removing template storage info by name.'
        );
        $this->getResponse()->addTemplateStorageInfo($template);
        $count = count($this->getResponse()->export()['templateStorageInfo']);
        $this->getResponse()->removeTemplateStorageInfo(
            $template->getUniqueId()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['templateStorageInfo'])
                <
                $count
            ),
            'Failed removing template storage info by id.'
        );
    }

    public function testGetTemplateStorageInfoReturnsArrayOfStorableInstancesForAssignedTemplates()
    {
        $this->turnSwitchableComponentOn($this->getResponse());
        $template = $this->getMockTemplate();
        $this->getResponse()->addTemplateStorageInfo($template);
        $this->assertEquals(
            [$template->export()['storable']],
            $this->getResponse()->getTemplateStorageInfo(),
            'getTemplateStorageInfo() did not return array of storable instances for assigned output components.'
        );
    }

    public function testGetTemplateStorageInfoReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnSwitchableComponentOff($this->getResponse());
        $this->getResponse()->addTemplateStorageInfo(
            $this->getMockTemplate()
        );
        $this->assertEmpty(
            $this->getResponse()->getTemplateStorageInfo(),
            'getTemplateStorageInfo() must return an empty array if state is false.'
        );
    }

    public function testAddORequestStorageInfoAddsSpecifiedORequestsStorableInstance(): void
    {
        $initialCount = count(
            $this->getResponse()->export()['requestStorageInfo']
        );
        $this->getResponse()->addRequestStorageInfo($this->getMockRequest());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                >
                $initialCount
            ),
            'addOutput() failed to add output component\'s storable instance.'
        );
    }

    public function testRemoveRequestStorageInfoRemovesSpecifiedRequestsStorableInstance(): void
    {
        $request = $this->getMockRequest();
        $this->getResponse()->addRequestStorageInfo($request);
        $count = count($this->getResponse()->export()['requestStorageInfo']);
        $this->getResponse()->removeRequestStorageInfo($request->getName());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                <
                $count
            ),
            'Failed removing request storage info by name.'
        );
        $this->getResponse()->addRequestStorageInfo($request);
        $count = count($this->getResponse()->export()['requestStorageInfo']);
        $this->getResponse()->removeRequestStorageInfo(
            $request->getUniqueId()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                <
                $count
            ),
            'Failed removing request storage info by id.'
        );
    }

    public function testRESPONSE_CONTAINERConstantIsAssignedStringRESPONSES(): void
    {
        $this->assertEquals("RESPONSES", $this->getResponse()::RESPONSE_CONTAINER);
        $this->assertEquals("RESPONSES", StandardResponse::RESPONSE_CONTAINER);
    }

    public function testGetContainerReturnsValueOfRESPONSE_CONTAINERConstant(): void
    {
        $this->assertEquals(
            $this->getResponse()::RESPONSE_CONTAINER,
            $this->getResponse()->getContainer()
        );
        $this->assertEquals(
            $this->getResponse()::RESPONSE_CONTAINER,
            $this->getResponse()->export()['storable']->getContainer()
        );
    }

    protected function setResponseParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getResponse());
        $this->setSwitchableComponentParentTestInstances();
    }
}
