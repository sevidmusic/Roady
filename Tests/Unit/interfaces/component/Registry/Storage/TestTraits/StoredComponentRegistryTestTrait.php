<?php

namespace UnitTests\interfaces\component\Registry\Storage\TestTraits;

use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

trait StoredComponentRegistryTestTrait
{

    private $storedComponentRegistry;

    public function testAcceptedImplementationPropertyIsAssignedNamespaceOfADefinedInterfacePostInstantiation(): void
    {
        $this->assertTrue(
            interface_exists($this->getStoredComponentRegistry()->export()['acceptedImplementation'])
        );
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    public function setStoredComponentRegistry(StoredComponentRegistry $storedComponentRegistry)
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
    }

    public function testAcceptedImplementationPropertyIsAssignedNamespaceOfADefinedComponentImplementationPostInstantiation(): void
    {
        $this->assertTrue(
            $this->getStoredComponentRegistry()->export()['acceptedImplementation'] === 'DarlingCms\interfaces\component\Component'
            ||
            in_array(
                'DarlingCms\interfaces\component\Component',
                class_implements($this->getStoredComponentRegistry()->export()['acceptedImplementation']),
                true
            )
        );
    }

    public function testComponentCrudPropertyIsAssignedAnInstanceOfAComponentCrudImplementationPostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingCms\interfaces\component\Crud\ComponentCrud',
                class_implements($this->getStoredComponentRegistry()->export()['componentCrud'])
            )
        );
    }

    public function testRegistryPropertyIsSetToAnEmptyArrayPostInstantiation(): void
    {
        $this->assertEquals([], $this->getStoredComponentRegistry()->export()['registry']);
    }

    public function testGetAcceptedImplementationReturnsSameNamespaceAssignedToAcceptedImplementationPropertyOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getStoredComponentRegistry()->export()['acceptedImplementation'],
            $this->getStoredComponentRegistry()->getAcceptedImplementation()
        );
    }

    public function testGetComponentCrudReturnsSameComponentCrudImplementationInstanceAssignedToComponentCrudPropertyOnInstantiation(): void
    {
        $this->assertEquals(
            $this->getStoredComponentRegistry()->export()['componentCrud'],
            $this->getStoredComponentRegistry()->getComponentCrud()
        );
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsAlreadyRegistered(): void
    {
        $this->getStoredComponentRegistry()->export()['componentCrud']->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry());
        $this->assertEquals(
            1,
            count($this->getStoredComponentRegistry()->export()['registry'])
        );
        $this->getStoredComponentRegistry()->export()['componentCrud']->delete($this->getStoredComponentRegistry());
    }

    protected function setStoredComponentRegistryParentTestInstances(): void
    {
        $this->setComponent($this->getStoredComponentRegistry());
        $this->setComponentParentTestInstances();
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentDoesNotExistInStorage(): void
    {
        $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry());
        $this->assertEquals(
            0,
            count($this->getStoredComponentRegistry()->export()['registry'])
        );
    }

    public function testRegisterComponentDoesNotAddComponentsStorableToRegistryPropertysArrayIfComponentIsNotAnAcceptedImplementation(): void
    {
        $this->getStoredComponentRegistry()->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry']);
        $this->getStoredComponentRegistry()->export()['componentCrud']->create($this->getStoredComponentRegistry()->export()['componentCrud']);
        $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry()->export()['componentCrud']);
        $this->assertEquals(
            0,
            count($this->getStoredComponentRegistry()->export()['registry'])
        );
        $this->getStoredComponentRegistry()->export()['componentCrud']->delete($this->getStoredComponentRegistry()->export()['componentCrud']);
    }

    public function testRegisterComponentAddsComponentsStorableToRegistryPropertysArrayIfComponentExistsInStorageAndIsNotAlreadyRegisteredAndIsAnAcceptedImplementation(): void
    {
        $this->getStoredComponentRegistry()->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry']);
        $this->getStoredComponentRegistry()->export()['componentCrud']->create($this->getStoredComponentRegistry());
        $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry());
        $this->assertTrue(
            in_array(
                $this->getStoredComponentRegistry()->export()['storable'],
                $this->getStoredComponentRegistry()->export()['registry'],
                true
            )
        );
    }

    public function testRegisterComponentReturnsTrueIfComponentWasRegistered(): void
    {
        $this->getStoredComponentRegistry()->export()['componentCrud']->create($this->getStoredComponentRegistry());
        $status = $this->getStoredComponentRegistry()->registerComponent($this->getStoredComponentRegistry());
        if(
            in_array(
                $this->getStoredComponentRegistry()->export()['storable'],
                $this->getStoredComponentRegistry()->export()['registry'],
                true
            )
        )
        {
            $this->assertTrue($status);
        }
        $this->getStoredComponentRegistry()->export()['componentCrud']->delete($this->getStoredComponentRegistry());
    }

}
