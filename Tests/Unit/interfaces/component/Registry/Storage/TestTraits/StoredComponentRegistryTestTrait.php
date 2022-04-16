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
 * protected function setStoredComponentRegistryParentTestInstances(): void
 * public function getStoredComponentRegistry(): StoredComponentRegistry
 * public function setStoredComponentRegistry(
 *     StoredComponentRegistry $storedComponentRegistry
 * ): void
 *
 */

trait StoredComponentRegistryTestTrait
{

    /**
     * @var StoredComponentRegistry $storedComponentRegistry
     */
    private StoredComponentRegistry $storedComponentRegistry;

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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()->registerComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()->emptyRegistry();
        $this->assertEquals(
            [],
            $this->getStoredComponentRegistry()
                 ->export()['registry']
        );
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create(
                 $this->getStoredComponentRegistry()
                      ->export()['componentCrud']
             );
        $this->getStoredComponentRegistry()->registerComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()->registerComponent(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud']
        );
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create(
                 $this->getStoredComponentRegistry()
                      ->export()['componentCrud']
             );
        $this->getStoredComponentRegistry()->registerComponent(
            $this->getStoredComponentRegistry()
        );
        $this->getStoredComponentRegistry()->registerComponent(
            $this->getStoredComponentRegistry()
                 ->export()['componentCrud']
        );
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete(
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete(
                 $this->getStoredComponentRegistry()
                      ->export()['componentCrud']
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create(
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete(
                 $this->getStoredComponentRegistry()
                      ->export()['componentCrud']
             );
    }

    public function testRegisterComponentReturnsFalseIfComponentWasNotRegistered(): void
    {
        $this->getStoredComponentRegistry()
             ->import(
                 ['acceptedImplementation' => ComponentCrud::class]
             );
        $status = $this->getStoredComponentRegistry()
                       ->registerComponent(
                           $this->getStoredComponentRegistry()
                       );
        if (
            !in_array(
                $this->getStoredComponentRegistry()
                     ->export()['storable'],
                 $this->getStoredComponentRegistry()
                      ->export()['registry'],
                true
            )
        ) {
            $this->assertFalse($status);
        }
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($this->getStoredComponentRegistry());
    }

    public function testRegisterComponentReturnsTrueIfComponentWasRegistered(): void
    {
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()->export()['componentCrud']
                                           ->delete(
                                               $this->getStoredComponentRegistry()
                                           );
    }

    public function testRegistryPropertyIsSetToAnEmptyArrayPostInstantiation(): void
    {
        $this->assertEquals([], $this
             ->getStoredComponentRegistry()
             ->export()['registry']);
    }

    public function testUnRegisterComponentRemovesSpecifiedStorableFromRegistryPropertysArray(): void
    {
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()
             ->registerComponent(
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

        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($this->getStoredComponentRegistry());
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()
             ->registerComponent(
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
        $this->getStoredComponentRegistry()
             ->export()['componentCrud']
             ->delete($this->getStoredComponentRegistry());
    }

    /**
     * @return array<string, string>
     */
    private function classImplements(string|object $class): array
    {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
    }

    protected function setStoredComponentRegistryParentTestInstances(): void
    {
        $this->setComponent($this->getStoredComponentRegistry());
        $this->setComponentParentTestInstances();
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    public function setStoredComponentRegistry(
        StoredComponentRegistry $storedComponentRegistry
    ): void
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
    }

}
