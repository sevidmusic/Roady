<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Driver\Storage\Base as StorageDriver;
use DarlingCms\interfaces\primary\Storable;

trait ComponentCrudTestTrait
{

    private $componentCrud;

    public function testStorageDriverIsSetAndIsAStorageDriverPostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingCms\interfaces\component\Driver\Storage\Base',
                class_implements($this->getComponentCrudStorageDriver())
            )
        );
    }

    private function getComponentCrudStorageDriver(): StorageDriver
    {
        return $this->getComponentCrud()->export()['storageDriver'];
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->componentCrud;
    }

    public function setComponentCrud(ComponentCrud $componentCrud): void
    {
        $this->componentCrud = $componentCrud;
    }

    public function testCreateReturnsTrue(): void
    {
        $this->assertTrue($this->getComponentCrud()->create($this->getComponentCrud()));
    }

    public function testReadReturnsSpecifiedComponent(): void
    {
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->assertEquals(
            $this->getComponentCrud()->getUniqueId(),
            $this->getComponentCrud()->read($this->getComponentCrudStorable())->getUniqueId()
        );
    }

    private function getComponentCrudStorable(): Storable
    {
        return $this->getComponentCrud()->export()['storable'];
    }

    public function testDeleteRemovesSpecifiedComponent(): void
    {
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->getComponentCrud()->delete($this->getComponentCrudStorable());
        $this->assertNotEquals(
            $this->getComponentCrud()->getUniqueId(),
            $this->getComponentCrud()->read($this->getComponentCrudStorable())->getUniqueId()
        );
    }

    public function testUpdateUpdatesSpecifiedComponent(): void
    {
        $standardComponent = $this->getComponentCrud()->read($this->getComponentCrudStorable());
        $this->getComponentCrud()->create($this->getComponentCrud());
        $storedComponent = $this->getComponentCrud()->read($this->getComponentCrudStorable());
        $this->getComponentCrud()->update($this->getComponentCrudStorable(), $standardComponent);
        $this->assertNotEquals(
            $storedComponent->getUniqueId(),
            $this->getComponentCrud()->read($this->getComponentCrudStorable())->getUniqueId(),
            'Update did not update specified component.'
        );
    }

    public function testReadAllReturnsArrayOfComponentsStoredInSpecifiedContainerAtSpecifiedLocation()
    {
        $this->getComponentCrud()->create($this->getComponentCrud());
        $components = $this->getComponentCrud()->readAll(
            $this->getComponentCrud()->getLocation(),
            $this->getComponentCrud()->getContainer()
        );
        $this->assertTrue(in_array($this->getComponentCrud(), $components));
    }

    protected function setComponentCrudParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getComponentCrud());
        $this->setSwitchableComponentParentTestInstances();
    }
}
