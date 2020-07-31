<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;

trait PrimaryFactoryTestTrait
{

    private $primaryFactory;

    public function testBuildIdentifiableReturnsAIdentifiableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Identifiable',
                class_implements($this->getPrimaryFactory()->buildIdentifiable('AssignedName'))
            )
        );
    }

    public function getPrimaryFactory(): PrimaryFactory
    {
        return $this->primaryFactory;
    }

    public function setPrimaryFactory(PrimaryFactory $primaryFactory)
    {
        $this->primaryFactory = $primaryFactory;
    }

    public function testBuildIdentifiableReturnsIdentifiableImplementationInstanceWhoseAssignedNameMatchesSpecifiedName(): void
    {
        $expectedName = 'ExpectedName';
        $identifiable = $this->getPrimaryFactory()->buildIdentifiable($expectedName);
        $this->assertEquals($expectedName, $identifiable->getName());
    }

    public function testBuildStorableReturnsAStorableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Storable',
                class_implements($this->getPrimaryFactory()->buildStorable('AssignedName', 'AssignedContainer'))
            )
        );
    }

    public function testBuildStorableReturnsStorableImplementationInstanceWhoseAssignedNameMatchesSpecifiedName(): void
    {
        $expectedName = 'ExpectedName';
        $storable = $this->getPrimaryFactory()->buildStorable($expectedName, 'AssignedContainer');
        $this->assertEquals($expectedName, $storable->getName());
    }

    public function testBuildStorableReturnsStorableImplementationInstanceWhoseAssignedContainerMatchesSpecifiedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $storable = $this->getPrimaryFactory()->buildStorable('AssignedName', $expectedContainer);
        $this->assertEquals($expectedContainer, $storable->getContainer());
    }

    public function testBuildStorableReturnsStorableWhoseLocationMatchesFactorysAppInstancesLocation(): void
    {
        $this->assertEquals(
            $this->getPrimaryFactory()->export()['app']->getLocation(),
            $this->getPrimaryFactory()->buildStorable('AssignedName', 'AssignedContainer')->getLocation(),
            'buildStorable() MUST return a Storable whose assigned location matches the Factory\'s App\'s assigned location.'
        );
    }

    public function testBuildClassifiableReturnsAClassifiableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Classifiable',
                class_implements($this->getPrimaryFactory()->buildClassifiable())
            )
        );
    }

    public function testBuildExportableReturnsAExportableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Exportable',
                class_implements($this->getPrimaryFactory()->buildExportable())
            )
        );
    }

    public function testBuildSwitchableReturnsASwitchableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Switchable',
                class_implements($this->getPrimaryFactory()->buildSwitchable())
            )
        );
    }

    public function testBuildPositionableReturnsAPositionableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingDataManagementSystem\interfaces\primary\Positionable',
                class_implements($this->getPrimaryFactory()->buildPositionable(rand(0, 1000)))
            )
        );
    }

    public function testBuildPositionableReturnsPositionableImplementationInstanceWhoseAssignedPositionMatchesSpecifiedPosition(): void
    {
        $expectedPosition = 420.87;
        $positionable = $this->getPrimaryFactory()->buildPositionable($expectedPosition);
        $this->assertEquals($expectedPosition, $positionable->getPosition());
    }

    protected function setPrimaryFactoryParentTestInstances(): void
    {
        $this->setFactory($this->getPrimaryFactory());
        $this->setFactoryParentTestInstances();
    }

}
