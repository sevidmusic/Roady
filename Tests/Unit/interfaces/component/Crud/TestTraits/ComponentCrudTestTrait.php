<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use RuntimeException;
use roady\interfaces\component\Component;
use roady\classes\component\Component as StandardComponent;
use roady\interfaces\component\Crud\ComponentCrud;
use roady\interfaces\component\Driver\Storage\StorageDriver;
use roady\interfaces\primary\Storable;
use roady\classes\primary\Storable as StandardStorable;

/**
 * The ComponentCrudTestTrait defines tests for implementations of
 * the ComponentCrud interface.
 *
 * Methods:
 *
 * private function newComponentInstance(): StandardComponent
 * private function setComponentCrudToTestsStateToFalse(): void
 * private function setComponentCrudToTestsStateToTrue(): void
 * protected function setComponentCrudToTestParentTestInstances(): void
 * public function componentCrudToTest(): ComponentCrud
 * public function setComponentCrudToTest(
 * public function tearDown(): void
 *
 * Test Methods:
 *
 * public function testCreateReturnsFalseAndDoesNotCreateComponentIfStateIsFalse(): void
 * public function testCreateReturnsTrue(): void
 * public function testDeleteRemovesSpecifiedComponent(): void
 * public function testDeleteReturnsFalseAndDoesNotDeleteComponentIfStateIsFalse(): void
 * public function testExportStorageDriverReturnsAStorageDriver(): void
 * public function testReadAllReturnsAnEmptyArrayIfStateIsFalse(): void
 * public function testReadAllReturnsArrayOfComponentsStoredInSpecifiedContainerAtSpecifiedLocation(): void
 * public function testReadByNameAndTypeReturnsComponentWhoseNameAndTypeMatchSpecifiedNameAndTypeIfAStoredComponentWithMatchngNameAndTypeExists(): void
 * public function testReadByNameAndTypeReturnsComponentWhoseNameLoctionAndContainerAreDEFAULTIfAMatchIsNotFound(): void
 * public function testReadByNameAndTypeThrowsRuntimeExceptionIfAMatchIsNotFound(): void
 * public function testReadReturnsMockComponentInstanceIfStateIsFalse(): void
 * public function testReadReturnsSpecifiedComponent(): void
 * public function testStorageDriverIsOnUponInstantiation(): void
 * public function testUpdateReturnsFalseAndDoesNotUpdateComponentIfStateIsFalse(): void
 * public function testUpdateUpdatesSpecifiedComponent(): void
 *
 * Issues:
 * @see https://github.com/sevidmusic/roady/issues/315
 * @see https://github.com/sevidmusic/roady/issues/320
 * @see https://github.com/sevidmusic/roady/issues/322
 *
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
     * Return a new instance of a roady\classes\component\Component.
     *
     * @return StandardComponent
     */
    private function newComponentInstance(): StandardComponent
    {
        return new StandardComponent(
            new StandardStorable(
                'TestComponent',
                $this->componentCrudToTest()->getLocation(),
                $this->componentCrudToTest()->getContainer(),
            )
        );
    }

    /**
     * Set the state of the ComponentCrud to test to false.
     *
     * @return void
     */
    private function setComponentCrudToTestsStateToFalse(): void
    {
        if ($this->componentCrudToTest()->getState() === true) {
            $this->componentCrudToTest()->switchState();
        }
    }

    /**
     * Switch the state of the ComponentCrud to test to true.
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
     * ComponentCrud implementations are also implementations of
     * the roady\interfaces\component\SwitchableComponent interface,
     * and therefore must pass the tests defined by the
     * Tests\Unit\interfaces\component\TestTraits\SwitchableComponentTestTrait
     *
     * This method passes the ComponentCrud implementation instance
     * to be tested to the setSwitchableComponent() method defined by the
     * Tests\Unit\interfaces\component\TestTraits\SwitchableComponentTestTrait.
     *
     * @return void
     */
    protected function setComponentCrudToTestParentTestInstances(): void
    {
        $this->setSwitchableComponent(
            $this->componentCrudToTest()
        );
        $this->setSwitchableComponentParentTestInstances();
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
    public function setComponentCrudToTest(
        ComponentCrud $componentCrudToTest
    ): void
    {
        $this->componentCrudToTest = $componentCrudToTest;
    }

    public function tearDown(): void
    {
        $storedComponents = $this->componentcrudToTest()->readAll(
            $this->componentCrudToTest()->getLocation(),
            $this->componentCrudToTest()->getContainer(),
        );
        foreach($storedComponents as $component) {
            $this->componentCrudToTest()->delete($component);
        }
    }

    /**
     * Test that create() returns false, and does not create
     * the specified Component if the ComponentCrud's state
     * is false.
     *
     * @return void
     */
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
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getUniqueId(),
            'create() must not update component if state is false.'
        );
    }

    /**
     * Test that create() returns true if Component was created
     * successfully.
     *
     * @todo Refactor testCreateReturnsTrue() to be
     *       testCreateReturnsTrueIfComponentWasCreated()
     *
     * @see https://github.com/sevidmusic/roady/issues/315
     *
     */
    public function testCreateReturnsTrue(): void
    {
        $this->assertTrue(
            $this->componentCrudToTest()->create(
                $this->componentCrudToTest()
            ),
            $this->componentCrudToTest()::class .
            '->create() must return true if Component' .
            'was created successfully.'
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
            $this->componentCrudToTest(),
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            ),
            $this->componentCrudToTest()::class .
            '->delete() must delete the specified Component.'
        );
    }

    /**
     * Test that delete() returns false, and does not delete
     * the specified Component if the ComponentCrud's state
     * is false.
     *
     * @return void
     */
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
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getUniqueId(),
            $this->componentCrudToTest()->getUniqueId(),
            'delete() must not update component if state is false.'
        );
    }

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
            'Exporting a ComponentCrud\'s StorageDriver via ' .
            $this->componentCrudToTest()::class .
            '->export()[\'storageDriver\'] ' .
            'must return an object that implements the ' .
            StorageDriver::class .
            'interface.'
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

    /**
     * Test that readAll() returns an array of all Components stored
     * at the specified location in the specified container.
     *
     * @todo Refactor to include more stored test Components.
     *
     * @see https://github.com/sevidmusic/roady/issues/320
     *
     * @return void
     */
    public function testReadAllReturnsArrayOfComponentsStoredInSpecifiedContainerAtSpecifiedLocation(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $components = $this->componentCrudToTest()->readAll(
            $this->componentCrudToTest()->getLocation(),
            $this->componentCrudToTest()->getContainer()
        );
        $this->assertTrue(
            in_array(
                $this->componentCrudToTest(), $components
            ),
            $this->componentCrudToTest()::class .
            '->readAll() must return an array of all the ' .
            'Components stored at the specified location: ' .
            $this->componentCrudToTest()->getLocation() . ' ' .
            ', in the specified contianer: ' .
            $this->componentCrudToTest()->getContainer()
        );
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

    /**
     * Test that an appropriately configured instance of a
     * roady\classes\component\Component is returned by
     * read() if the ComponentCrud's state is false.
     *
     * @todo Refactor/rename test to: testReadReturnsComponentInstanceWhoseNameLocationAndConatinerAreREAD_ERROR_COMPONENT_CRUD_STATE_IS_FALSEIfState
     *
     * @see https://github.com/sevidmusic/roady/issues/322
     *
     * @return void
     */
    public function testReadReturnsMockComponentInstanceIfStateIsFalse(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $this->setComponentCrudToTestsStateToFalse();
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getName(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getLocation(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
        $this->assertEquals(
            'MOCKCOMPONENT',
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getContainer(),
            'read() must return a MOCKCOMPONENT if state is false.'
        );
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
            $this->componentCrudToTest(),
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            ),
            $this->componentCrudToTest()::class .
            '->read() must return the stored Component whose ' .
            'assigned ' . Storable::class . ' implementation ' .
            'instance matches the specified ' . Storable::class .
            ' implementation instance.'
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

    /**
     * Test that update returns false and does not update the
     * specified Component if the ComponentCrud's state is false.
     *
     * @return void
     */
    public function testUpdateReturnsFalseAndDoesNotUpdateComponentIfStateIsFalse(): void
    {
        $component = $this->newComponentInstance();
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
            $this->componentcrudToTest()->read(
                $this->componentcrudToTest()
            )->getUniqueId(),
            $component->getUniqueId(),
            'update() must not update component if state is false.'
        );
        $this->assertEquals(
            $this->componentCrudToTest()->read(
                $this->componentCrudToTest()
            )->getUniqueId(),
            $this->componentCrudToTest()->getUniqueId(),
            'update() must not update component if state is false.'
        );
    }

    /**
     * Test that update() updates the specified Component.
     *
     * @return void
     */
    public function testUpdateUpdatesSpecifiedComponent(): void
    {
        $this->componentCrudToTest()->create(
            $this->componentCrudToTest()
        );
        $standardComponent = $this->newComponentInstance();
        $this->componentCrudToTest()->update(
            $this->componentCrudToTest(),
            $standardComponent
        );
        $this->assertEquals(
            $standardComponent,
            $this->componentCrudToTest()->read(
                $standardComponent
            ),
            'Update must update the specified component.' .
            'Expected Component Id:' . PHP_EOL .
            $standardComponent->getUniqueId() . PHP_EOL .
            'Actual Component Id:' . PHP_EOL .
            $this->componentCrudToTest()->read(
                $standardComponent
            )->getUniqueId()
        );
    }

}
