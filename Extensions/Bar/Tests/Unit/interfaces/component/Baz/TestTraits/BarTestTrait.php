<?php

namespace Extensions\Bar\Tests\Unit\interfaces\component\Baz\TestTraits;

use Extensions\Bar\core\interfaces\component\Baz\Bar;

// This may be needed, dont use unless it is: use UnitTests\interfaces\component\TestTraits;

trait BarTestTrait
{

    private $bar;

    protected function setBarParentTestInstances(): void
    {
        $this->setComponent($this->getBar());
        $this->setComponentParentTestInstances();
    }

    public function getBar(): Bar
    {
        return $this->bar;
    }

    public function setBar(Bar $bar)
    {
        $this->bar = $bar;
    }

}
