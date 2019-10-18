<?php

require_once(__DIR__ . '/BazTest.php');
use DarlingCms\classes\fobBarBaz\Baz;

class BazTest extends BarTest
{

    public function setUp(): void
    {
        $this->component = new Baz('name', 'type', 'location', 'container', true);
    }

    public function testHasStateAndStateIsBool()
    {
        $this->assertNotEmpty($this->component->getState());
        $this->assertIsBool($this->component->getState());
    }

    public function testCanSwitchState(){
        $initialState = $this->component->getState();
        $switchState = $this->component->switchState();
        $postState = $this->component->getState();
        $this->assertNotEquals($initialState, $postState);
        $this->assertTrue($switchState);
    }
}
