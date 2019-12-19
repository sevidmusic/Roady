<?php

namespace UnitTests\interfaces\primary\TestTraits;

use UnitTests\TestUtilities\StringTestUtility;

trait SwitchableTestTrait {

    public function testTestIsRunning() {
        $this->assertTrue(true);
    }

    public function testCanSwitchState() {
        $initialState = $this->switchable->getState();
        $this->switchable->switchState();
        return $this->assertNotEquals(
            $initialState,
            $this->switchable->getState()
        );
    }

}
