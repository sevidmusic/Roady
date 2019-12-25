<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\Switchable;

trait SwitchableTestTrait
{
    /**
     * @var Switchable
     */
    protected $switchable;

    /** @noinspection PhpUnused */
    public function testCanSwitchState()
    {
        $initialState = $this->switchable->getState();
        $this->switchable->switchState();
        return $this->assertNotEquals(
            $initialState,
            $this->switchable->getState()
        );
    }

    public function setSwitchable(Switchable $switchable): void
    {
        $this->switchable = $switchable;
    }

}
