<?php

namespace UnitTests\interfaces\component\Template\UserInterface\TestTraits;

use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;

trait StandardUITemplateTestTrait
{

    private StandardUITemplateInterface $standardUITemplate;
    private OutputComponentInterface $outputComponent;

    public function testAddTypeAddsSpecifiedComponentsTypeAtAppropriateIndex(): void
    {
        $this->getStandardOutputComponent()->increasePosition();
        $this->getStandardUITemplate()->addType(
            $this->getStandardOutputComponent()
        );
        $this->assertTrue(
            isset(
                $this->getStandardUITemplate()->export()['types'][strval(
                    $this->getStandardOutputComponent()->getPosition()
                )]
            ),
            'Failed to add type to appropriate index.'
        );
    }

    private function getStandardOutputComponent(): OutputComponentInterface
    {
        if (isset($this->outputComponent)) {
            return $this->outputComponent;
        }
        $this->outputComponent = new CoreOutputComponent(
            new CoreStorable(
                'StandardOutputComponent',
                'StandardOutputComponent',
                'StandardOutputComponent'
            ),
            new CoreSwitchable(),
            new CorePositionable()
        );
        if ($this->outputComponent->getState() === false) {
            $this->outputComponent->switchState();
        }
        return $this->outputComponent;
    }

    public function getStandardUITemplate(): StandardUITemplateInterface
    {
        return $this->standardUITemplate;
    }

    public function setStandardUITemplate(StandardUITemplateInterface $standardUITemplate): void
    {
        $this->standardUITemplate = $standardUITemplate;
    }

    public function testAddTypeIncreasesPositionIfCorrespondingIndexOccupied(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $this->getStandardUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->assertTrue(
            isset(
                $this->getStandardUITemplate()->export()['types']['0'],
                $this->getStandardUITemplate()->export()['types']['0.01'],
                $this->getStandardUITemplate()->export()['types']['0.02']
            )
        );
    }

    public function testRemoveTypeRemovesType(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $this->getStandardUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->getStandardUITemplate()->removeType(
            $this->getStandardOutputComponent()->getType()
        );
        $this->getStandardUITemplate()->removeType($this->getStandardOutputComponent()->getType());
        $this->assertEmpty(
            $this->getStandardUITemplate()->export()['types'],
            'Failed to remove all ' . $this->getStandardOutputComponent()->getType() . ' types from types array.'
        );
    }

    public function testGetTypesReturnsArrayOfAssignedTypes(): void
    {
        if ($this->getStandardUITemplate()->getState() === false) {
            $this->getStandardUITemplate()->switchState();
        }
        for ($i = 0; $i < 3; $i++) {
            $this->getStandardUITemplate()->addType(
                $this->getStandardOutputComponent()
            );
        }
        $this->assertEquals(
            3,
            count($this->getStandardUITemplate()->getTypes())
        );
    }

    public function testGetTypesReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->assertEmpty(
            $this->getStandardUITemplate()->getTypes(),
            'getTypes() must return empty array if state is false.'
        );
    }

    protected function setGenericUITemplateParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStandardUITemplate());
        $this->setSwitchableComponentParentTestInstances();
    }

}
