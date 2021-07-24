<?php

namespace UnitTests\interfaces\component\TestTraits;

use roady\interfaces\component\OutputComponent as OutputComponentInterface;

trait OutputComponentTestTrait
{

    private OutputComponentInterface $outputComponent;

    public function testPositionableInstanceIsSetOnInstantiation(): void
    {
        $this->assertTrue(
            isset($this->getOutputComponent()->export()['positionable']),
        );
    }

    protected function getOutputComponent(): OutputComponentInterface
    {
        return $this->outputComponent;
    }

    protected function setOutputComponent(OutputComponentInterface $outputComponent): void
    {
        $this->outputComponent = $outputComponent;
    }

    public function testGetOutputReturnsEmptyStringIfStateIsFalse(): void
    {
        $this->forceFalseState();
        $this->assertFalse(
            $this->getOutputComponent()->getState(),
            'Failed to properly test that getOutput() returns an empty string if state is false because state could not be set to false'
        );
        $this->assertTrue(
            empty(
            $this->getOutputComponent()->getOutput()),
            'getOutput() returned a non empty string even though state is false. getOutput() must return an empty string if state is false.'
        );
    }

    private function forceFalseState(): void
    {
        if ($this->getOutputComponent()->getState() === true) {
            $this->getOutputComponent()->switchState();
        }
    }

    public function testGetPositionReturnsGreaterValueAfterCallToIncreasePosition(): void
    {
        $this->forceTrueState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->assertTrue(
            $this->getOutputComponent()->increasePosition(),
            'increasePosition() returned false'
        );
        $this->assertTrue(
            $initialPosition < $this->getOutputComponent()->getPosition(),
            'Failed to increase position.'
        );
    }

    private function forceTrueState(): void
    {
        if ($this->getOutputComponent()->getState() === false) {
            $this->getOutputComponent()->switchState();
        }
    }

    public function testIncreasePositionIncreasesPositionByOneHundredth(): void
    {
        $this->forceTrueState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->getOutputComponent()->increasePosition();
        $this->assertEquals(
            ((($initialPosition * 100) + 1) / 100),
            $this->getOutputComponent()->getPosition(),
            'Failed to increase position by .01.'
        );
    }

    public function testGetPositionReturnsLesserValueAfterCallToDecreasePosition(): void
    {
        $this->forceTrueState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->assertTrue(
            $this->getOutputComponent()->decreasePosition(),
            'decreasePosition() returned false'
        );
        $this->assertTrue(
            $initialPosition > $this->getOutputComponent()->getPosition(),
            'Failed to decrease position.'
        );
    }

    public function testDecreasePositionDecreasesPositionByOneHundredth(): void
    {
        $this->forceTrueState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->getOutputComponent()->decreasePosition();
        $this->assertEquals(
            ((($initialPosition * 100) - 1) / 100),
            $this->getOutputComponent()->getPosition(),
            'Failed to decrease position by .01.'
        );
    }

    public function testIncreasePositionDoesNotIncreasePositionIfStateIsFalse(): void
    {
        $this->forceFalseState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->getOutputComponent()->increasePosition();
        $this->assertEquals($initialPosition, $this->getOutputComponent()->getPosition());
    }

    public function testDecreasePositionDoesNotIncreasePositionIfStateIsFalse(): void
    {
        $this->forceFalseState();
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->getOutputComponent()->decreasePosition();
        $this->assertEquals($initialPosition, $this->getOutputComponent()->getPosition());
    }

    protected function setOutputComponentParentTestInstances(): void
    {
        $this->setPositionable($this->getOutputComponent());
        $this->setSwitchableComponent($this->getOutputComponent());
        $this->setSwitchableComponentParentTestInstances();
    }

}
