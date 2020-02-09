<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\interfaces\component\OutputComponent;

trait OutputComponentTestTrait
{

    private $outputComponent;

    public function testGetOutputReturnsEmptyStringIfStateIsFalse(): void
    {
        if ($this->getOutputComponent()->getState() === true) {
            $this->getOutputComponent()->switchState();
        }
        $this->assertFalse($this->getOutputComponent()->getState(), 'Failed to properly test that getOutput() returns an empty string if state is false because state could not be set to false');
        $this->assertTrue(empty($this->getOutputComponent()->getOutput()), 'getOutput() returned a non empty string even though state is false. getOutput() must return an empty string if state is false.');
    }

    protected function getOutputComponent(): OutputComponent
    {
        return $this->outputComponent;
    }

    protected function setOutputComponent(OutputComponent $outputComponent): void
    {
        $this->outputComponent = $outputComponent;
    }

    public function testGetPositionReturnsGreaterValueAfterCallToIncreasePosition(): void
    {
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->assertTrue($this->getOutputComponent()->increasePosition(), 'increasePosition() returned false');
        $this->assertTrue($initialPosition < $this->getOutputComponent()->getPosition(), 'Failed to increase position.');
    }

    public function testIncreasePositionIncreasesPositionByOneHundredth(): void
    {
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
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->assertTrue($this->getOutputComponent()->decreasePosition(), 'decreasePosition() returned false');
        $this->assertTrue($initialPosition > $this->getOutputComponent()->getPosition(), 'Failed to decrease position.');
    }

    public function testDecreasePositionDecreasesPositionByOneHundredth(): void
    {
        $initialPosition = $this->getOutputComponent()->getPosition();
        $this->getOutputComponent()->decreasePosition();
        $this->assertEquals(
            ((($initialPosition * 100) - 1) / 100),
            $this->getOutputComponent()->getPosition(),
            'Failed to decrease position by .01.'
        );
    }

    protected function setOutputComponentParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getOutputComponent());
        $this->setSwitchableComponentParentTestInstances();
    }

}
