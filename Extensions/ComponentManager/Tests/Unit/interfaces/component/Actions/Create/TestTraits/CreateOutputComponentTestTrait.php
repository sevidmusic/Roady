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

}
