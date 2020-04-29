<?php

namespace UnitTests\interfaces\component\Registry\Storage\TestTraits;

use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

trait StoredComponentRegistryTestTrait
{

    private $storedComponentRegistry;

    protected function setStoredComponentRegistryParentTestInstances(): void
    {
        $this->setComponent($this->getStoredComponentRegistry());
        $this->setComponentParentTestInstances();
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    public function setStoredComponentRegistry(StoredComponentRegistry $storedComponentRegistry)
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
    }

    public function testAcceptedImplementationPropertyIsAssignedNamespaceOfADefinedInterfacePostInstantiation(): void
    {
        $this->assertTrue(
            interface_exists($this->getStoredComponentRegistry()->export()['acceptedImplementation'])
        );
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

    public function testGetAcceptedImplementationReturnsSameNamesapaceAssignedToAcceptedImplementationPropertyOnInstantiation(): void
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
}
