<?php


use DarlingCms\classes\fobBarBaz\Foo;

class FooTest extends \PHPUnit\Framework\TestCase
{
    protected $component;

    public function setUp(): void
    {
        $this->component = new Foo('MyName','MyType');
    }

    public function testHasNameAndType(){
        $this->assertNotEmpty($this->component->getName());
        $this->assertNotEmpty($this->component->getType());
    }
}
