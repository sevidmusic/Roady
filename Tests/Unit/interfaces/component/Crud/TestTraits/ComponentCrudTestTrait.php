<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use \RuntimeException;

trait ComponentCrudTestTrait
{

    private ComponentCrudInterface $componentCrud;

    public function testStorageDriverIsSetAndIsAStorageDriverPostInstantiation(): void
    {
        $classImplements = class_implements($this->getComponentCrudStorageDriver());
        $this->assertTrue(
            in_array(
                'roady\interfaces\component\Driver\Storage\StorageDriver',
                (is_array($classImplements) ? $classImplements : [])
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

    public function testReadByNameAndTypeThrowsRuntimeExceptionIfAMatchIsNotFound(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponentCrud()->readByNameAndType(
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999))
        );
    }


    public function testReadByNameAndTypeReturnsComponentWhoseNameLoctionAndContainerAreDEFAULTIfAMatchIsNotFound(): void
    {
        $this->expectException(RuntimeException::class);
        $component = $this->getComponentCrud()->readByNameAndType(
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999))
        );
        $this->assertEquals('DEFAULT', $component->getName());
        $this->assertEquals('DEFAULT', $component->getLocation());
        $this->assertEquals('DEFAULT', $component->getContainer());
    }

    public function testReadByNameAndTypeReturnsComponentWhoseNameAndTypeMatchSpecifiedNameAndTypeIfAStoredComponentWithMatchngNameAndTypeExists(): void
    {
        $crud = $this->getComponentCrud();
        $crud->create($crud);
        $component = $crud->readByNameAndType(
            $crud->getName(),
            $crud->getType(),
            $crud->getLocation(),
            $crud->getContainer()
        );
        $this->assertEquals(
            $crud->getName(),
            $component->getName()
        );
        $this->assertEquals(
            $crud->getType(),
            $component->getType()
        );
        $crud->delete($crud);
    }
/*

// Addressing read()
    public function testReadReturnsComponentWhoseNameLocationAndContainerAreDEFAULTIfAMatchIsNotFound(): void
    public function testReadThrowsRuntimeExceptionIfAMatchNotFound(): void
*/
}
