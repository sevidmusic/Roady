<?php

namespace UnitTests\interfaces\component\Registry\Storage\TestTraits;

use roady\interfaces\component\Component;
use roady\interfaces\component\Crud\ComponentCrud;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry;

/*
 * The StoredComponentRegistry defines tests for
 * implementations of the
 * roady\interfaces\component\Registry\Storage\StoredComponentRegistry
 * interface.
 *
 * Test Methods:
 *
 * public function testExportingAcceptedImplementationReturnsNamespaceOfADefinedComponentImplementation(): void
 * public function testExportingAcceptedImplementationReturnsNamespaceOfADefinedInterfacePostInstantiation(): void
 * public function testComponentCrudPropertyIsAssignedAnInstanceOfAComponentCrudImplementationPostInstantiation(): void
 * public function testEmptyRegistryAssignsAnEmptyArrayToTheRegistryProperty(): void
 * public function testGetAcceptedImplementationReturnsSameNamespaceAssignedToAcceptedImplementationPropertyOnInstantiation(): void
 * public function testGetComponentCrudReturnsSameComponentCrudImplementationInstanceAssignedToComponentCrudPropertyOnInstantiation(): void
 * public function testGetRegisteredComponentsReadsAllRegisteredComponentsFromStorageAndReturnsThemInAnArray(): void
 * public function testGetRegistryReturnsArrayAssignedToRegistryProperty(): void
 * public function testPurgeRegistryRemovesAllStorablesThatReferenceComponentsThatNoLongerExistInStorageFromTheRegistryPropertysArray(): void
 * public function testRegisterComponentAddsComponentsStorableToRegistryPropertysArrayIfComponentExistsInStorageAndIsNotAlreadyRegisteredAndIsAnAcceptedImplementation(): void
 * public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentDoesNotExistInStorage(): void
 * public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsAlreadyRegistered(): void
 * public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsNotAnAcceptedImplementation(): void
 * public function testRegisterComponentReturnsFalseIfComponentWasNotRegistered(): void
 * public function testRegisterComponentReturnsTrueIfComponentWasRegistered(): void
 * public function testRegistryPropertyIsSetToAnEmptyArrayPostInstantiation(): void
 * public function testUnRegisterComponentRemovesSpecifiedStorableFromRegistryPropertysArray(): void
 * public function testUnRegisterComponentReturnsFalseIfSpecifiedStorableWasNotRemovedFromRegistryPropertysArray(): void
 * public function testUnRegisterComponentReturnsTrueIfSpecifiedStorableWasRemovedFromRegistryPropertysArray(): void
 *
 * Methods:
 *
 * private function classImplements(string|object $class): array
 * public function getStoredComponentRegistry(): StoredComponentRegistry
 * private function removeStoredComponent(
 *     Component $component
 * ): void
 * public function setStoredComponentRegistry(
 *     StoredComponentRegistry $storedComponentRegistry
 * ): void
 * protected function setStoredComponentRegistryParentTestInstances(): void
 * private function storeAndRegister(
 *     Component $component,
 *     StoredComponentRegistry $storedComponentRegistry
 * ): void
 * private function storeComponent(Component $component): void
 *
 */

trait StoredComponentRegistryTestTrait
{

    /**
     * @var StoredComponentRegistry $storedComponentRegistry
     */
    private StoredComponentRegistry $storedComponentRegistry;

    /**
     * @var array<int, Component> $storedComponents
     */
    private array $storedComponents = [];

    public function testExportingAcceptedImplementationReturnsNamespaceOfADefinedComponentImplementation(): void
    {
        $this->assertTrue(
            $this->getStoredComponentRegistry()
                 ->export()['acceptedImplementation']
             ===
             Component::class
            ||
            in_array(
                Component::class,
                $this->classImplements(
                    $this->getStoredComponentRegistry()
                         ->export()['acceptedImplementation']
                ),
                true
            )
        );
    }

    public function testExportingAcceptedImplementationReturnsNamespaceOfADefinedInterfacePostInstantiation(): void
    {
        $this->assertTrue(
            interface_exists(
                $this->getStoredComponentRegistry()
                     ->export()['acceptedImplementation']
            )
        );
    }

    public function testComponentCrudPropertyIsAssignedAnInstanceOfAComponentCrudImplementationPostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                ComponentCrud::class,
                $this->classImplements(
                    $this->getStoredComponentRegistry()
                         ->export()['componentCrud']
                )
            )
        );
    }

    public function testEmptyRegistryAssignsAnEmptyArrayToTheRegistryProperty(): void
    {
        $this->storeAndRegister(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry(),
        );
        $this->getStoredComponentRegistry()->emptyRegistry();
        $this->assertEquals(
            [],
            $this->getStoredComponentRegistry()
                 ->export()['registry']
        );
    }

    public function testGetAcceptedImplementationReturnsSameNamespaceAssignedToAcceptedImplementationPropertyOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getStoredComponentRegistry()
                 ->export()['acceptedImplementation'],
             $this->getStoredComponentRegistry()
                  ->getAcceptedImplementation()
        );
    }

    public function testGetComponentCrudReturnsSameComponentCrudImplementationInstanceAssignedToComponentCrudPropertyOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud'],
            $this->getStoredComponentRegistry()->getComponentCrud()
        );
    }

    public function testGetRegisteredComponentsReadsAllRegisteredComponentsFromStorageAndReturnsThemInAnArray(): void
    {
        $this->storeAndRegister(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry()
        );
        $this->storeAndRegister(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud'],
            $this->getStoredComponentRegistry()
        );
        /** Update the stored StoredComponentRegistry **/
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->update(
                 $this->getStoredComponentRegistry(),
                 $this->getStoredComponentRegistry()
             );
        $this->assertEquals(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry()
                 ->getRegisteredComponents()[0]
        );
        $this->assertEquals(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud'],
             $this->getStoredComponentRegistry()
                  ->getRegisteredComponents()[1]
        );
    }

    public function testGetRegistryReturnsArrayAssignedToRegistryProperty(): void
    {
        $this->assertEquals(
            $this->getStoredComponentRegistry()
                 ->export()['registry'],
            $this->getStoredComponentRegistry()->getRegistry()
        );
    }

    public function testPurgeRegistryRemovesAllStorablesThatReferenceComponentsThatNoLongerExistInStorageFromTheRegistryPropertysArray(): void
    {
        $this->storeAndRegister(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry()
        );
        $this->storeAndRegister(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud'],
            $this->getStoredComponentRegistry()
        );
        $this->removeStoredComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()->purgeRegistry();
        $this->assertTrue(
            !in_array(
                $this->getStoredComponentRegistry()
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
            &&
            in_array(
                $this->getStoredComponentRegistry()
                     ->export()['componentCrud']
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
        );
    }

    public function testRegisterComponentAddsComponentsStorableToRegistryPropertysArrayIfComponentExistsInStorageAndIsNotAlreadyRegisteredAndIsAnAcceptedImplementation(): void
    {
        $this->getStoredComponentRegistry()
             ->import(
                 [
                     'acceptedImplementation'
                     =>
                     StoredComponentRegistry::class
                 ]
             );
        $this->storeComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()
             ->registerComponent(
                 $this->getStoredComponentRegistry()
             );
        $this->assertTrue(
            in_array(
                $this->getStoredComponentRegistry()
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
        );
    }

    public function tearDown(): void
    {
        foreach($this->storedComponents as $storedComponent) {
            $this->removeStoredComponent($storedComponent);
        }
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentDoesNotExistInStorage(): void
    {
        $this->getStoredComponentRegistry()
             ->registerComponent(
                 $this->getStoredComponentRegistry()
             );
        $this->assertEquals(
            0,
            count(
                $this->getStoredComponentRegistry()
                     ->export()['registry']
            )
        );
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsAlreadyRegistered(): void
    {
        $this->storeComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()
             ->registerComponent(
                 $this->getStoredComponentRegistry()
             );
        $this->getStoredComponentRegistry()
             ->registerComponent(
                 $this->getStoredComponentRegistry()
             );
        $this->assertEquals(
            1,
            count(
                $this->getStoredComponentRegistry()
                     ->export()['registry']
            )
        );
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsNotAnAcceptedImplementation(): void
    {
        $this->getStoredComponentRegistry()
             ->import(
                 [
                     'acceptedImplementation'
                     =>
                     StoredComponentRegistry::class
                 ]
             );
        $this->storeComponent(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud']
        );
        $this->getStoredComponentRegistry()
             ->registerComponent(
                 $this->getStoredComponentRegistry()
                      ->export()['componentCrud']
             );
        $this->assertEquals(
            0,
            count(
                $this->getStoredComponentRegistry()
                     ->export()['registry']
            )
        );
    }

    public function testRegisterComponentReturnsFalseIfComponentWasNotRegistered(): void
    {
        $status = $this->getStoredComponentRegistry()
                       ->registerComponent(
                           $this->getStoredComponentRegistry()
                       );
        $this->assertFalse($status);
        $this->storeComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()
             ->import(
                 ['acceptedImplementation' => ComponentCrud::class]
             );
        $status = $this->getStoredComponentRegistry()
                       ->registerComponent(
                           $this->getStoredComponentRegistry()
                       );
        $this->assertFalse($status);
    }

    public function testRegisterComponentReturnsTrueIfComponentWasRegistered(): void
    {
        $this->storeComponent($this->getStoredComponentRegistry());
        $status = $this->getStoredComponentRegistry()
                       ->registerComponent(
                           $this->getStoredComponentRegistry()
                       );
        if (
            in_array(
                $this->getStoredComponentRegistry()
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
        ) {
            $this->assertTrue($status);
        }
    }

    public function testRegistryPropertyIsSetToAnEmptyArrayPostInstantiation(): void
    {
        $this->assertEquals([], $this
             ->getStoredComponentRegistry()
             ->export()['registry']);
    }

    public function testUnRegisterComponentRemovesSpecifiedStorableFromRegistryPropertysArray(): void
    {
        $this->storeAndRegister(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()
             ->unRegisterComponent(
                 $this->getStoredComponentRegistry()
             );
        $this->assertFalse(
            in_array(
                $this->getStoredComponentRegistry()
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
        );
    }

    public function testUnRegisterComponentReturnsFalseIfSpecifiedStorableWasNotRemovedFromRegistryPropertysArray(): void
    {
        $status = $this->getStoredComponentRegistry()
                       ->unRegisterComponent(
                           $this->getStoredComponentRegistry()
                       );
        $this->assertFalse($status);
    }

    public function testUnRegisterComponentReturnsTrueIfSpecifiedStorableWasRemovedFromRegistryPropertysArray(): void
    {
        $this->storeAndRegister(
            $this->getStoredComponentRegistry(),
            $this->getStoredComponentRegistry()
        );
        $status = $this->getStoredComponentRegistry()
                       ->unRegisterComponent(
                           $this->getStoredComponentRegistry()
                       );
        if (
        !in_array(
            $this->getStoredComponentRegistry()->export()['storable'],
            $this->getStoredComponentRegistry()->export()['registry'],
            true
        )
        ) {
            $this->assertTrue($status);
        }
    }

    /**
     * Return an array of the interfaces which are implemented
     * by the specified class or object instance
     *
     * Note: If a class is specified, and the specified class does
     *       not exist, an empty array will be returned.
     *
     * @param class-string $class The name of a existing class or
     *                            interface, including the fully
     *                            qualified namespace, or an object
     *                            instance.
     *
     * @return array<string, string> An array of the interfaces
     *                               which are implemented by
     *                               the specified class or
     *                               object instance, or an
     *                               empty array if a class
     *                               that does not exist is
     *                               specified.
     */
    private function classImplements(string|object $class): array
    {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    private function removeStoredComponent(
        Component $component
    ): void
    {
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($component);
    }

    public function setStoredComponentRegistry(
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
    }

    protected function setStoredComponentRegistryParentTestInstances(): void
    {
        $this->setComponent($this->getStoredComponentRegistry());
        $this->setComponentParentTestInstances();
    }

    /**
     * Store the specified Component, and register it with the
     * specified StoredComponentRegistry.
     *
     * @param Component $component The Component to store.
     *
     * @param StoredComponentRegistry $storedComponentRegistry
     *                                The StoredComponentRegistry
     *                                to register the stored
     *                                Component with.
     *
     * @return void
     */
    private function storeAndRegister(
        Component $component,
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {

        /** Store the specified Component **/
        $this->storeComponent($component);
        /**
         * Register the specified Component with the specified
         * StoredComponentRegistry
         */
        $storedComponentRegistry->registerComponent(
            $component
        );
    }

    /**
     * Store the specified Component.
     *
     * @param Component $component The Component to store.
     *
     * @return void
     */
    private function storeComponent(Component $component): void
    {
        /** Store the specified Component **/
        if(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud']
                 ->create($component)
        ) {
             array_push($this->storedComponents, $component);
        }
    }
}

