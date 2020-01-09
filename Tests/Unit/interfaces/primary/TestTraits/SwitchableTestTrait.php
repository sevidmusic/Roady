<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Switchable;

trait SwitchableTestTrait
{
    private $switchable;

    public function testCanSwitchState(): void
    {
        $initialState = $this->getSwitchable()->getState();
        $this->getSwitchable()->switchState();
        $this->assertNotEquals(
            $initialState,
            $this->getSwitchable()->getState()
        );
    }

    protected function getSwitchable(): Switchable
    {
        return $this->switchable;
    }

    protected function setSwitchable(Switchable $switchable): void
    {
        $this->switchable = $switchable;
    }

    public function testGetStateReturnsBoolean(): void
    {
        $this->assertTrue(is_bool($this->getSwitchable()->getState()));
    }

}
