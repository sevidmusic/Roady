<?php

namespace UnitTests\interfaces\primary\TestTraits;

use roady\interfaces\primary\Positionable as PositionableInterface;

trait PositionableTestTrait
{

    private PositionableInterface $positionable;

    public function testDecreasePositionDecreasesPositionByOneHundredth(): void
    {
        $initialPosition = $this->getPositionable()->getPosition();
        $this->getPositionable()->decreasePosition();
        $this->assertEquals(
            ((($initialPosition * 100) - 1) / 100),
            $this->getPositionable()->getPosition(),
            'Failed to decrease position by .01.'
        );
    }

    protected function getPositionable(): PositionableInterface
    {
        return $this->positionable;
    }

    protected function setPositionable(PositionableInterface $positionable): void
    {
        $this->positionable = $positionable;
    }

    public function testGetPositionReturnsGreaterValueAfterCallToIncreasePosition(): void
    {
        $initialPosition = $this->getPositionable()->getPosition();
        $this->assertTrue($this->getPositionable()->increasePosition(), 'increasePosition() returned false');
        $this->assertTrue($initialPosition < $this->getPositionable()->getPosition(), 'Failed to increase position.');
    }

    public function testGetPositionReturnsLesserValueAfterCallToDecreasePosition(): void
    {
        $initialPosition = $this->getPositionable()->getPosition();
        $this->assertTrue($this->getPositionable()->decreasePosition(), 'decreasePosition() returned false');
        $this->assertTrue($initialPosition > $this->getPositionable()->getPosition(), 'Failed to decrease position.');
    }

    public function testIncreasePositionIncreasesPositionByOneHundredth(): void
    {
        $initialPosition = $this->getPositionable()->getPosition();
        $this->getPositionable()->increasePosition();
        $this->assertEquals(
            ((($initialPosition * 100) + 1) / 100),
            $this->getPositionable()->getPosition(),
            'Failed to increase position by .01.'
        );
    }

}
