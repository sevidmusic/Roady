<?php

namespace UnitTests\interfaces\primary\TestTraits;

use roady\interfaces\primary\Switchable as SwitchableInterface;

trait SwitchableTestTrait
{
    private SwitchableInterface $switchable;

    public function testCanSwitchState(): void
    {
        $initialState = $this->getSwitchable()->getState();
        $this->getSwitchable()->switchState();
        $this->assertNotEquals(
            $initialState,
            $this->getSwitchable()->getState()
        );
    }

    protected function getSwitchable(): SwitchableInterface
    {
        return $this->switchable;
    }

    protected function setSwitchable(SwitchableInterface $switchable): void
    {
        $this->switchable = $switchable;
    }

    public function testGetStateReturnsBoolean(): void
    {
        $this->assertTrue(is_bool($this->getSwitchable()->getState()));
    }

}
