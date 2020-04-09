<?php

namespace Extensions\ComponentManager\Tests\Unit\interfaces\component\Actions\Create\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\ComponentManager\core\interfaces\component\Actions\Create\CreateOutputComponent;

trait CreateOutputComponentTestTrait
{

    private $createOutputComponent;

    public function testComponentNameIsSetInPostAfterCallToDo(): void
    {
        $this->getCreateOutputComponent()->do($this->getCurrentRequest());
        $this->assertTrue(
            isset($this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentName']),
            'The "componentName" was not set in Post after ' . $this->getCreateOutputComponent()->getType() . '::do() was called which may indicate a corrupted or incorrect Request was passed to CreateOutputComponent::do(), The "componentName" MUST be set in the Post data of the Request passed to CreateOutputComponent->do() since OutputComponents require a name to be created. CreateOutputComponent->do() MUST internally set the "componentName" explitly with Request->import() if the "componentName" is not set in Post, i.e., "componentName" MUST always be set after do() is called.'
        );
        //
    }

    public function testComponentNameSetInPostMatchesSuppliedComponentNameAfterDoIsCalled(): void
    {
        $currentRequest = $this->getCurrentRequest();
        $currentRequest->import(['post' => ['componentName' => 'TestComponentName']]);
        $this->getCreateOutputComponent()->do($currentRequest);
        $this->assertEquals($currentRequest->getPost()['componentName'], $this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentName']);
    }

    public function testComponentOutputIsSetInPostAfterCallToDo(): void
    {
        $this->getCreateOutputComponent()->do($this->getCurrentRequest());
        $this->assertTrue(
            isset($this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentOutput']),
            'The "componentOutput" was not set in Post after ' . $this->getCreateOutputComponent()->getType() . '::do() was called which may indicate a corrupted or incorrect Request was passed to CreateOutputComponent::do(), The "componentOutput" MUST be set in the Post data of the Request passed to CreateOutputComponent->do(), it can be set to an empty string, but it MUST be set. CreateOutputComponent->do() MUST internally set the "componentOutput" explitly with Request->import() if the "componentOutput" is not set in Post, i.e., "componentOutput" MUST always be set after do() is called.'
        );
    }

    public function testComponentOutputSetInPostMatchesSuppliedComponentNameAfterDoIsCalled(): void
    {
        $currentRequest = $this->getCurrentRequest();
        $currentRequest->import(['post' => ['componentName' => 'TestComponentName']]);
        $this->getCreateOutputComponent()->do($currentRequest);
        $this->assertEquals($currentRequest->getPost()['componentName'], $this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentName']);
    }

    protected function setCreateOutputComponentParentTestInstances(): void
    {
        $this->setAction($this->getCreateOutputComponent());
        $this->setActionParentTestInstances();
    }

    public function getCreateOutputComponent(): CreateOutputComponent
    {
        return $this->createOutputComponent;
    }

    public function setCreateOutputComponent(CreateOutputComponent $createOutputComponent): void
    {
        $this->createOutputComponent = $createOutputComponent;
    }

    public function testComponentPositionIsSetInPostAfterCallToDo(): void
    {
        $this->getCreateOutputComponent()->do($this->getCurrentRequest());
        $this->assertTrue(
            isset($this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentPosition']),
            'The "componentPosition" was not set in Post after ' . $this->getCreateOutputComponent()->getType() . '::do() was called which may indicate a corrupted or incorrect Request was passed to CreateOutputComponent::do(), The "componentPosition" MUST be set in the Post data of the Request passed to CreateOutputComponent->do() in order to assign the OutputComponent a position. CreateOutputComponent->do() MUST internally set the "componentPosition" explitly with Request->import() if the "componentPosition" is not set in Post, i.e., "componentPosition" MUST always be set after do() is called.'
        );
    }

    public function testComponentPositionSetInPostMatchesSuppliedComponentNameAfterDoIsCalled(): void
    {
        $currentRequest = $this->getCurrentRequest();
        $currentRequest->import(['post' => ['componentName' => 'TestComponentName']]);
        $this->getCreateOutputComponent()->do($currentRequest);
        $this->assertEquals($currentRequest->getPost()['componentName'], $this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentName']);
    }


}
