<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use RuntimeException;
use roady\interfaces\component\Component;
use roady\interfaces\component\Crud\ComponentCrud;
use roady\interfaces\component\Driver\Storage\StorageDriver;
use roady\interfaces\primary\Storable;

/**
 * The ComponentCrudTestTrait defines tests for implementations of
 * the ComponentCrud interface.
 */
trait ComponentCrudTestTrait
{

    /**
     * @var ComponentCrud $componentCrudToTest An instance of a
     *                                         ComponentCrud
     *                                         implementation
     *                                         to test.
     */
    private ComponentCrud $componentCrudToTest;

    /**
     * Test that exporting a ComponentCrud's storageDriver
     * returns an object instance that is an implementation of the
     * StorageDriver interface.
     *
     * @return void
     */
    public function testExportStorageDriverReturnsAStorageDriver(): void
    {
        $classImplements = class_implements(
            $this->componentCrudToTest()->export()['storageDriver'],
        );
        $this->assertTrue(
            in_array(
                StorageDriver::class,
                (is_array($classImplements) ? $classImplements : [])
            ),
            'Exporting a ComponentCrud\'s StorageDriver via' .
            'ComponentCrud->export()[\'storageDriver\']' .
            'must return an object that implements the' .
            StorageDriver::class .
            ' interface'
        );
    }

    /**
     * Return the ComponentCrud implementation instance to be
     * tested.
     *
     * @return ComponentCrud
     */
    public function componentCrudToTest(): ComponentCrud
    {
        return $this->componentCrudToTest;
    }

    /**
     * Set the ComponentCrud implementation instance to be tested.
     *
     * @param ComponentCrud $componentCrudToTest The ComponentCrud
     *                                           implementation
     *                                           instance to be
     *                                           tested.
     * @return void
     */
    public function setComponentCrud(
        ComponentCrud $componentCrudToTest
    ): void
    {
        $this->componentCrudToTest = $componentCrudToTest;
    }

    /**
     * @todo ComponentCrud: Refactor appropriate test methods,
     *                      and implement missing tests methods.
     *
     * Refactor testCreateReturnsTrue() to be
     * testCreateReturnsTrueIfComponentWasCreated()
     *
     * @see https://github.com/sevidmusic/roady/issues/315
     *
     */
    public function testCreateReturnsTrue(): void
    {
        $this->assertTrue(
            $this->componentCrudToTest()->create(
                $this->componentCrudToTest()
            )
        );
    }

    /**
     * Switch the state of the ComponentCrud currently being tested
     * to true.
     *
     * @return void
     */
    private function setComponentCrudToTestsStateToTrue(): void
    {
        if ($this->componentCrudToTest()->getState() === false) {
            $this->componentCrudToTest()->switchState();
        }
    }

    /**
     * Test that read() returns the specified Component.
     *
     * @return void
     */
    public function testReadReturnsSpecifiedComponent(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->assertEquals(
            $this->componentCrudToTest()->getUniqueId(),
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getUniqueId()
        );
    }

    /**
     * Return the ComponentCrud to test from storage if it exists.
     *
     * @return Component
     */
    private function getStoredComponent(): Component
    {
        return $this->componentCrudToTest()->read(
            $this->componentCrudToTest()
        );
    }

    /** Test that delete() removes the specified Component.
     *
     * @return void
     */
    public function testDeleteRemovesSpecifiedComponent(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->componentCrudToTest()->delete(
            $this->componentCrudToTest()
        );
        $this->assertNotEquals(
            $this->componentCrudToTest()->getUniqueId(),
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getUniqueId()
        );
    }

    /**
     * @here
     * Test that update() updates the specified Component.
     *
     * @return void
     */

    public function testUpdateUpdatesSpecifiedComponent(): void
    {
        $standardComponent = $this->getStoredComponent();
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $storedComponent = $this->getStoredComponent();
        $this->componentCrudToTest()->update(
            $this->componentCrudToTest(),
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
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $components = $this->componentCrudToTest()->readAll(
            $this->componentCrudToTest()->getLocation(),
            $this->componentCrudToTest()->getContainer()
        );
        $this->assertTrue(in_array(
            $this->componentCrudToTest(), $components)
        );
    }

    public function testReadReturnsMockComponentInstanceIfStateIsFalse(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->getStoredComponent()->getName(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->getStoredComponent()->getLocation(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->getStoredComponent()->getContainer(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
    }

    private function setComponentCrudToTestsStateToFalse(): void
    {
        if ($this->componentCrudToTest()->getState() === true) {
            $this->componentCrudToTest()->switchState();
        }
    }

    public function testUpdateReturnsFalseAndDoesNotUpdateComponentIfStateIsFalse(): void
    {
        $component = $this->getStoredComponent();
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertFalse(
            $this->componentCrudToTest()->update(
                $this->componentCrudToTest(),
                $component
            ),
            'update() must return false if state is false.'
        );
        $this->setComponentCrudToTestsStateToTrue();
        $this->assertNotEquals(
            $this->getStoredComponent()->getUniqueId(),
            $component->getUniqueId(),
            'update() must not update component if state is false.'
        );
        $this->assertEquals(
            $this->getStoredComponent()->getUniqueId(),
            $this->componentCrudToTest()->getUniqueId(),
            'update() must not update component if state is false.'
        );
    }

    public function testDeleteReturnsFalseAndDoesNotDeleteComponentIfStateIsFalse(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertFalse(
            $this->componentCrudToTest()->delete(
                $this->componentCrudToTest()
            ),
            'delete() must return false if state is false.'
        );
        $this->setComponentCrudToTestsStateToTrue();
        $this->assertEquals(
            $this->getStoredComponent()->getUniqueId(),
            $this->componentCrudToTest()->getUniqueId(),
            'delete() must not update component if state is false.'
        );
    }

    public function testCreateReturnsFalseAndDoesNotCreateComponentIfStateIsFalse(): void
    {
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertFalse(
            $this->componentCrudToTest()->create(
                $this->componentCrudToTest()
            ),
            'create() must return false if state is false.'
        );
        $this->setComponentCrudToTestsStateToTrue();
        $this->assertNotEquals(
            $this->componentCrudToTest()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'create() must not update component if state is false.'
        );
    }

    public function testReadAllReturnsAnEmptyArrayIfStateIsFalse(): void
    {
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertEmpty(
            $this->componentCrudToTest()->readAll(
                $this->componentCrudToTest()->getLocation(),
                $this->componentCrudToTest()->getContainer()
            ),
            'readAll() must return an empty array if state is false.'
        );
    }

    public function testStorageDriverIsOnUponInstantiation(): void
    {
        $this->assertTrue(
            $this->componentCrudToTest()
                 ->export()['storageDriver']
                 ->getState(),
             'The storage driver\'s state must be true or the' .
             'ComponentCrud will not be able to operate on ' .
             'stored data.'
        );
    }

    protected function setComponentCrudParentTestInstances(): void
    {
        $this->setSwitchableComponent(
            $this->componentCrudToTest()
        );
        $this->setSwitchableComponentParentTestInstances();
    }

    public function testReadByNameAndTypeThrowsRuntimeExceptionIfAMatchIsNotFound(): void
    {
        $this->expectException(RuntimeException::class);
        $this->componentCrudToTest()->readByNameAndType(
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999)),
            strval(rand(1000, 9999))
        );
    }


    public function testReadByNameAndTypeReturnsComponentWhoseNameLoctionAndContainerAreDEFAULTIfAMatchIsNotFound(): void
    {
        $this->expectException(RuntimeException::class);
        $component = $this->componentCrudToTest()->readByNameAndType(
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
        $crud = $this->componentCrudToTest();
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
    }

    public function tearDown(): void
    {
        $this->componentcrudToTest()->delete(
            $this->componentcrudToTest()
        );
    }
}
