<?php

namespace Extensions\Baz\Tests\Unit\interfaces\component\TestTraits;

use Extensions\Baz\core\interfaces\component\Bazzer;

// This may be needed, dont use unless it is: use UnitTests\interfaces\component\TestTraits;

trait BazzerTestTrait
{

    private $bazzer;

    protected function setBazzerParentTestInstances(): void
    {
        $this->setComponent($this->getBazzer());
        $this->setComponentParentTestInstances();
    }

    public function getBazzer(): Bazzer
    {
        return $this->bazzer;
    }

    public function setBazzer(Bazzer $bazzer)
    {
        $this->bazzer = $bazzer;
    }

}
