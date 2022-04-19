<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

trait PrimaryFactoryTestTrait
{

    private PrimaryFactoryInterface $primaryFactory;

    public function testBuildIdentifiableReturnsAIdentifiableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                IdentifiableInterface::class,
                $this->classImplements($this->getPrimaryFactory()->buildIdentifiable('PrimaryFactoryTestTraitIdentifiableAssignedName'))
            )
        );
    }

    public function getPrimaryFactory(): PrimaryFactoryInterface
    {
        return $this->primaryFactory;
    }

    public function setPrimaryFactory(PrimaryFactoryInterface $primaryFactory): void
    {
        $this->primaryFactory = $primaryFactory;
    }

    public function testBuildIdentifiableReturnsIdentifiableImplementationInstanceWhoseAssignedNameMatchesSpecifiedName(): void
    {
        $expectedName = 'PrimaryFactoryTestTraitIdentifiableExpectedName';
        $identifiable = $this->getPrimaryFactory()->buildIdentifiable($expectedName);
        $this->assertEquals($expectedName, $identifiable->getName());
    }

    public function testBuildStorableReturnsAStorableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                StorableInterface::class,
                $this->classImplements(
                    $this->getPrimaryFactory()->buildStorable(
                        'PrimaryFactoryTestTraitStorableAssignedName',
                        'PrimaryFactoryTestTraitStorableAssignedContainer'
                    )
                )
            )
        );
    }

    public function testBuildStorableReturnsStorableImplementationInstanceWhoseAssignedNameMatchesSpecifiedName(): void
    {
        $expectedName = 'PrimaryFactoryTestTraitStorableExpectedName';
        $storable = $this->getPrimaryFactory()->buildStorable(
            $expectedName,
            'PrimaryFactoryTestTraitStorableAssignedContainer'
        );
        $this->assertEquals($expectedName, $storable->getName());
    }

    public function testBuildStorableReturnsStorableImplementationInstanceWhoseAssignedContainerMatchesSpecifiedContainer(): void
    {
        $expectedContainer = 'PrimaryFactoryTestTraitStorableExpectedContainer';
        $storable = $this->getPrimaryFactory()->buildStorable(
            'PrimaryFactoryTestTraitStorableAssignedName',
            $expectedContainer
        );
        $this->assertEquals($expectedContainer, $storable->getContainer());
    }

    public function testBuildStorableReturnsStorableWhoseLocationMatchesFactorysAppInstancesLocation(): void
    {
        $this->assertEquals(
            $this->getPrimaryFactory()->export()['app']->getLocation(),
            $this->getPrimaryFactory()->buildStorable('PrimaryFactoryTestTraitStorableAssignedName', 'PrimaryFactoryTestTraitStorableAssignedContainer')->getLocation(),
            'buildStorable() MUST return a Storable whose assigned location matches the Factory\'s App\'s assigned location.'
        );
    }

    public function testBuildClassifiableReturnsAClassifiableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                ClassifiableInterface::class,
                $this->classImplements($this->getPrimaryFactory()->buildClassifiable())
            )
        );
    }

    public function testBuildExportableReturnsAExportableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                ExportableInterface::class,
                $this->classImplements($this->getPrimaryFactory()->buildExportable())
            )
        );
    }

    public function testBuildSwitchableReturnsASwitchableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                SwitchableInterface::class,
                $this->classImplements($this->getPrimaryFactory()->buildSwitchable())
            )
        );
    }

    public function testBuildPositionableReturnsAPositionableImplementationInstance(): void
    {
        $this->assertTrue(
            in_array(
                PositionableInterface::class,
                $this->classImplements($this->getPrimaryFactory()->buildPositionable(rand(0, 1000)))
            )
        );
    }

    /**
     * @return array<string, string>
     */
    private function classImplements(string|object $class): array {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
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
