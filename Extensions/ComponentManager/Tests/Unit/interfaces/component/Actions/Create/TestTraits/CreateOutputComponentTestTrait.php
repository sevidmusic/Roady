<?php

namespace Extensions\ComponentManager\Tests\Unit\interfaces\component\Actions\Create\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\ComponentManager\core\interfaces\component\Actions\Create\CreateOutputComponent;

trait CreateOutputComponentTestTrait
{

    private $createOutputComponent;

    public function getCreateOutputComponent(): CreateOutputComponent
    {
        return $this->createOutputComponent;
    }

    public function setCreateOutputComponent(CreateOutputComponent $createOutputComponent): void
    {
        $this->createOutputComponent = $createOutputComponent;
    }

    protected function setCreateOutputComponentParentTestInstances(): void
    {
        $this->setAction($this->getCreateOutputComponent());
        $this->setActionParentTestInstances();
    }

    public function testComponentNameIsSetInPostAfterCallToDo(): void
    {
        $this->getCreateOutputComponent()->do($this->getCurrentRequest());
        $this->assertTrue(
            isset($this->getCreateOutputComponent()->export()['currentRequest']->getPost()['componentName']),
            'The "componentName" was not set in Post after ' . $this->getCreateOutputComponent()->getType() . '::do() was called which may indicate a corrupted or incorrect Request was passed to CreateOutputComponent::do(), The "componentName" MUST be set in the Post data of the Request passed to CreateOutputComponent->do() since OutputComponents require a name to be created. CreateOutputComponent->do() MUST internally set the "componentName" explitly with Request->import() if the "componentName" is not set in Post, i.e., "componentName" MUST always be set after do() is called.'
        );
        //
    }
}
