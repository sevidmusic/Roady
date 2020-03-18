<?php

namespace Extensions\Foo\Tests\Unit\interfaces\component\TestTraits;

use Extensions\Foo\core\interfaces\component\Foo;

// This may be needed, dont use unless it is: use UnitTests\interfaces\component\TestTraits;

trait FooTestTrait
{

    private $foo;

    protected function setFooParentTestInstances(): void
    {
        $this->setComponent($this->getFoo());
        $this->setComponentParentTestInstances();
    }

    public function getFoo(): Foo
    {
        return $this->foo;
    }

    public function setFoo(Foo $foo)
    {
        $this->foo = $foo;
    }

}
