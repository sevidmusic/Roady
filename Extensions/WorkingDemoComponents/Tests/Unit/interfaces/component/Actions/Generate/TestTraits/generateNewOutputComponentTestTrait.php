<?php

namespace Extensions\WorkingDemoComponents\Tests\Unit\interfaces\component\Actions\Generate\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\WorkingDemoComponents\core\interfaces\component\Actions\Generate\generateNewOutputComponent;

trait generateNewOutputComponentTestTrait
{

    private $generateNewOutputComponent;

    public function getgenerateNewOutputComponent(): generateNewOutputComponent
    {
        return $this->generateNewOutputComponent;
    }

    public function setgenerateNewOutputComponent(generateNewOutputComponent $generateNewOutputComponent): void
    {
        $this->generateNewOutputComponent = $generateNewOutputComponent;
    }

    protected function setgenerateNewOutputComponentParentTestInstances(): void
    {
        $this->setAction($this->getgenerateNewOutputComponent());
        $this->setActionParentTestInstances();
    }

}
