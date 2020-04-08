<?php

namespace Extensions\Foo\Tests\Unit\interfaces\component\Bar\Bazzer\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\Foo\core\interfaces\component\Bar\Bazzer\FooAction;

trait FooActionTestTrait
{

    private $fooAction;

    public function getFooAction(): FooAction
    {
        return $this->fooAction;
    }

    public function setFooAction(FooAction $fooAction): void
    {
        $this->fooAction = $fooAction;
    }

    protected function setFooActionParentTestInstances(): void
    {
        $this->setAction($this->getFooAction());
        $this->setActionParentTestInstances();
    }

}
