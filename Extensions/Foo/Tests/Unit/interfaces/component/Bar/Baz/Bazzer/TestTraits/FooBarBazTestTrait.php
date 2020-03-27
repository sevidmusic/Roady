<?php

namespace Extensions\Foo\Tests\Unit\interfaces\component\Bar\Baz\Bazzer\TestTraits;

use Extensions\Foo\core\interfaces\component\Bar\Baz\Bazzer\FooBarBaz;

trait FooBarBazTestTrait
{

    private $fooBarBaz;

    protected function setFooBarBazParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getFooBarBaz());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getFooBarBaz(): FooBarBaz
    {
        return $this->fooBarBaz;
    }

    protected function setFooBarBaz(FooBarBaz $fooBarBaz): void
    {
        $this->fooBarBaz = $fooBarBaz;
    }

}
