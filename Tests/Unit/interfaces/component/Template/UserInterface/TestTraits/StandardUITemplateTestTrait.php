<?php

namespace UnitTests\interfaces\component\Template\UserInterface\TestTraits;

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;

trait StandardUITemplateTestTrait
{

    private $genericUITemplate;
    private $standardOutputComponent;

    public function testAddTypeAddsSpecifiedComponentsTypeAtAppropriateIndex(): void
    {
        $this->getStandardOutputComponent()->increasePosition();
        $this->getGenericUITemplate()->addType(
            $this->getStandardOutputComponent()
        );
        $this->assertTrue(
            isset(
                $this->getGenericUITemplate()->export()['types'][strval(
                    $this->getStandardOutputComponent()->getPosition()
                )]
            ),
            'Failed to add type to appropriate index.'
        );
    }

    private function getStandardOutputComponent(): OutputComponent
    {
        if (isset($this->standardOutputComponent)) {
            return $this->standardOutputComponent;
        }
        $this->standardOutputComponent = new OutputComponent(
            new Storable(
                'StandardOutputComponent',
                'StandardOutputComponent',
                'StandardOutputComponent'
            ),
            new Switchable(),
            new Positionable()
        );
        if ($this->standardOutputComponent->getState() === false) {
            $this->standardOutputComponent->switchState();
        }
        return $this->standardOutputComponent;
    }

    public function getGenericUITemplate(): StandardUITemplate
    {
        return $this->genericUITemplate;
    }

    public function setGenericUITemplate(StandardUITemplate $genericUITemplate): void
    {
        $this->genericUITemplate = $genericUITemplate;
    }

    public function testAddTypeIncreasesPositionIfCorrespondingIndexOccupied(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $this->getGenericUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->assertTrue(
            isset(
                $this->getGenericUITemplate()->export()['types']['0'],
                $this->getGenericUITemplate()->export()['types']['0.01'],
                $this->getGenericUITemplate()->export()['types']['0.02']
            )
        );
    }

    public function testRemoveTypeRemovesType(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $this->getGenericUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->getGenericUITemplate()->removeType(
            $this->getStandardOutputComponent()->getType()
        );
        $this->getGenericUITemplate()->removeType($this->getStandardOutputComponent()->getType());
        $this->assertEmpty(
            $this->getGenericUITemplate()->export()['types'],
            'Failed to remove all ' . $this->getStandardOutputComponent()->getType() . ' types from types array.'
        );
    }

    public function testGetTypesReturnsArrayOfAssignedTypes(): void
    {
        if ($this->getGenericUITemplate()->getState() === false) {
            $this->getGenericUITemplate()->switchState();
        }
        for ($i = 0; $i < 3; $i++) {
            $this->getGenericUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->assertEquals(
            3,
            count($this->getGenericUITemplate()->getTypes())
        );
    }

    public function testGetTypesReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->assertEmpty(
            $this->getGenericUITemplate()->getTypes(),
            'getTypes() must return empty array if state is false.'
        );
    }

    protected function setGenericUITemplateParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getGenericUITemplate());
        $this->setSwitchableComponentParentTestInstances();
    }

}
