<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StandardStorageDriver as StandardStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

trait ComponentCrudTestTrait
{

    private ComponentCrudInterface $componentCrud;

    public function testStorageDriverIsSetAndIsAStorageDriverPostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\component\Driver\Storage\StandardStorageDriver',
                class_implements($this->getComponentCrudStorageDriver())
            )
        );
    }

    private function getComponentCrudStorageDriver(): StandardStorageDriverInterface
    {
        return $this->getComponentCrud()->export()['storageDriver'];
    }

    public function getComponentCrud(): ComponentCrudInterface
    {
        return $this->componentCrud;
    }

    public function setComponentCrud(ComponentCrudInterface $componentCrud): void
    {
        $this->componentCrud = $componentCrud;
    }

    public function testCreateReturnsTrue(): void
    {
        $this->turnCrudOn();
        $this->assertTrue(
            $this->getComponentCrud()->create($this->getComponentCrud())
        );
    }

    private function turnCrudOn(): void
    {
        if ($this->getComponentCrud()->getState() === false) {
            $this->getComponentCrud()->switchState();
        }
    }

    public function testReadReturnsSpecifiedComponent(): void
    {
        $this->turnCrudOn();
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->assertEquals(
            $this->getComponentCrud()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId()
        );
    }

    private function getStoredComponent(): ComponentInterface
    {
        return $this->getComponentCrud()->read($this->getComponentCrudStorable());
    }

    private function getComponentCrudStorable(): StorableInterface
    {
        return $this->getComponentCrud()->export()['storable'];
    }

    public function testDeleteRemovesSpecifiedComponent(): void
    {
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->getComponentCrud()->delete($this->getComponentCrudStorable());
        $this->assertNotEquals(
            $this->getComponentCrud()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId()
        );
    }

    /**
     * @todo Implement following tests:
     * testUpdatePreservesUniqueId()
     */
    public function testUpdateUpdatesSpecifiedComponent(): void
    {
        $standardComponent = $this->getStoredComponent();
        $this->getComponentCrud()->create($this->getComponentCrud());
        $storedComponent = $this->getStoredComponent();
        $this->getComponentCrud()->update(
            $this->getComponentCrudStorable(),
            $standardComponent
        );
        $this->assertNotEquals(
            $storedComponent->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'Update did not update specified component.'
        );
    }

    public function testReadAllReturnsArrayOfComponentsStoredInSpecifiedContainerAtSpecifiedLocation(): void
    {
        $this->turnCrudOn();
        $this->getComponentCrud()->create($this->getComponentCrud());
        $components = $this->getComponentCrud()->readAll(
            $this->getComponentCrud()->getLocation(),
            $this->getComponentCrud()->getContainer()
        );
        $this->assertTrue(in_array($this->getComponentCrud(), $components));
    }

    public function testReadReturnsMockComponentInstanceIfStateIsFalse(): void
    {
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->turnCrudOff();
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getName(),
            'read() must return a __MOCK__COMPONENT__ if state is false.'
        );
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getLocation(),
            'read() must return a __MOCK__COMPONENT__ if state is false.'
        );
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getContainer(),
            'read() must return a __MOCK__COMPONENT__ if state is false.'
        );
    }

    private function turnCrudOff(): void
    {
        if ($this->getComponentCrud()->getState() === true) {
            $this->getComponentCrud()->switchState();
        }
    }

    public function testUpdateReturnsFalseAndDoesNotUpdateComponentIfStateIsFalse(): void
    {
        $this->turnCrudOn();
        $component = $this->getStoredComponent();
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->turnCrudOff();
        $this->assertFalse(
            $this->getComponentCrud()->update(
                $this->getComponentCrudStorable(),
                $component
            ),
            'update() must return false if state is false.'
        );
        $this->turnCrudOn();
        $this->assertNotEquals(
            $this->getStoredComponent()->getUniqueId(),
            $component->getUniqueId(),
            'update() must not update component if state is false.'
        );
        $this->assertEquals(
            $this->getStoredComponent()->getUniqueId(),
            $this->getComponentCrud()->getUniqueId(),
            'update() must not update component if state is false.'
        );
    }

    public function testDeleteReturnsFalseAndDoesNotDeleteComponentIfStateIsFalse(): void
    {
        $this->turnCrudOn();
        $this->getComponentCrud()->create($this->getComponentCrud());
        $this->turnCrudOff();
        $this->assertFalse(
            $this->getComponentCrud()->delete(
                $this->getComponentCrudStorable()
            ),
            'delete() must return false if state is false.'
        );
        $this->turnCrudOn();
        $this->assertEquals(
            $this->getStoredComponent()->getUniqueId(),
            $this->getComponentCrud()->getUniqueId(),
            'delete() must not update component if state is false.'
        );
    }

    public function testCreateReturnsFalseAndDoesNotCreateComponentIfStateIsFalse(): void
    {
        $this->turnCrudOff();
        $this->assertFalse(
            $this->getComponentCrud()->create(
                $this->getComponentCrud()
            ),
            'create() must return false if state is false.'
        );
        $this->turnCrudOn();
        $this->assertNotEquals(
            $this->getComponentCrud()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'create() must not update component if state is false.'
        );
    }

    public function testReadAllReturnsAnEmptyArrayIfStateIsFalse(): void
    {
        $this->turnCrudOff();
        $this->assertEmpty(
            $this->getComponentCrud()->readAll(
                $this->getComponentCrud()->getLocation(),
                $this->getComponentCrud()->getContainer()
            ),
            'readAll() must return an empty array if state is false.'
        );
    }

    public function testStorageDriverIsOnUponInstantiation(): void
    {
        $this->assertTrue(
            $this->getComponentCrud()->export()['storageDriver']->getState(),
            'The storage driver\'s state must be true or the ComponentCrud will not be able to operate on stored data.'
        );
    }

    protected function setComponentCrudParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getComponentCrud());
        $this->setSwitchableComponentParentTestInstances();
    }
}
