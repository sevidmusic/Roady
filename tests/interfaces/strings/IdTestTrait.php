<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\Id;
use tests\interfaces\strings\AlphanumericTextTestTrait;

/**
 * The IdTestTrait defines common tests for
 * implementations of the Id interface.
 *
 * @see Id
 *
 */
trait IdTestTrait
{

    /**
     * The AlphanumericTextTestTrait defines common tests for
     * implementations of the Id interface.
     *
     */
    use AlphanumericTextTestTrait;

    /**
     * @var Id $id An instance of a Id implementation to test.
     */
    protected Id $id;

    /**
     * Return the Id implementation instance to test.
     *
     * @return Id
     *
     */
    protected function idTestInstance(): Id
    {
        return $this->id;
    }

    /**
     * Set the Id implementation instance to test.
     *
     * @param Id $idTestInstance An instance of an implementation of
     *                           the Id interface to test.
     *
     * @return void
     *
     */
    protected function setIdTestInstance(
        Id $idTestInstance
    ): void
    {
        $this->id = $idTestInstance;
    }

    public function testLengthIsGreaterThanOrEqualTo60(): void
    {
        for($i = 0; $i < 1000; $i++) {
            $this->setUpWithNewInstance();
            $this->assertGreaterThanOrEqual(
                60,
                $this->idTestInstance()->length()
            );
        }
    }

    public function testLengthIsLessThanOrEqualTo80(): void
    {
        for($i = 0; $i < 1000; $i++) {
            $this->setUpWithNewInstance();
            $this->assertLessThanOrEqual(
                80,
                $this->idTestInstance()->length()
            );
        }
    }

    abstract public function setUpWithNewInstance(): void;
}

