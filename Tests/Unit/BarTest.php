<?php
require_once(__DIR__ . '/FooTest.php');

use DarlingCms\classes\fobBarBaz\Bar;

class BarTest extends \FooTest
{

    public function setUp(): void
    {
        $this->component = new Bar('name', 'type', 'location', 'container');
    }

    public function testHasLocationAndContainer()
    {
        $this->assertNotEmpty($this->component->getLocation());
        $this->assertNotEmpty($this->component->getContainer());
    }
}
