<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\Id;
use tests\interfaces\strings\AlphanumericTextTestTrait;

/**
 * The IdTestTrait defines common tests for implementations of the
 * Id interface.
 *
 * @see Id
 *
 */
trait IdTestTrait
{

    /**
     * The AlphanumericTextTestTrait defines
     * common tests for implementations of
     * the roady\interfaces\strings\AlphanumericText
     * interface.
     *
     */
    use AlphanumericTextTestTrait;

    /**
     * @var Id $id An instance of an Id implementation to test.
     */
    protected Id $id;


    /**
     * Set up an instance of an implementation of the Id interface
     * for testing.
     *
     * This method must call setUpWithNewInstance();
     *
     * This method may perform any additional set up that may
     * be required.
     *
     * @return void
     *
     * ```
     * public function setUp(): void
     * {
     *     $this->setUpWithNewInstance();
     * }
     *
     * ```
     *
     */
    abstract public function setUp(): void;

    /**
     * Set up a new Id implementation instance for testing.
     *
     * This method must pass the Id implementation
     * instance to test to the setTextTestInstance(),
     * setSafeTextTestInstance(), setAlphanumericTextTestInstance(),
     * setIdTestInstance(), and setExpectedString() methods.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUpWithNewInstance(): void
     * {
     *     $id = new roady\classes\strings\Id();
     *     $this->setTextTestInstance($id);
     *     $this->setSafeTextTestInstance($id);
     *     $this->setAlphanumericTextTestInstance($id);
     *     $this->setIdTestInstance($id);
     *     $this->setExpectedString($id);
     * }
     *
     * ```
     */
    abstract public function setUpWithNewInstance(): void;

    /**
     * Return the Id implementation instance to test.
     *
     * @return Id
     *
     * @example
     *
     * ```
     * echo $this->idTestInstance();
     *
     * ```
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
     * @example
     *
     * ```
     * $this->setIdTestInstance(new roady\classes\strings\Id());
     *
     * ```
     *
     */
    protected function setIdTestInstance(
        Id $idTestInstance
    ): void
    {
        $this->id = $idTestInstance;
    }

    /**
     * Test that the length of an Id is greater than or equal to 60.
     *
     * @return void
     *
     */
    public function test_length_is_greater_than_or_equal_to_60(): void
    {
        for($i = 0; $i < 1000; $i++) {
            $this->setUpWithNewInstance();
            $this->assertGreaterThanOrEqual(
                60,
                $this->idTestInstance()->length(),
                $this->testFailedMessage(
                    $this->idTestInstance(),
                    '',
                    'An Id\'s length must be greater than or equal ' .
                    'to 60'
                )
            );
        }
    }

    /**
     * Test that the length of an Id is less than or equal to 80.
     *
     * @return void
     *
     */
    public function test_length_is_less_than_or_equal_to_80(): void
    {
        for($i = 0; $i < 1000; $i++) {
            $this->setUpWithNewInstance();
            $this->assertLessThanOrEqual(
                80,
                $this->idTestInstance()->length(),
                $this->testFailedMessage(
                    $this->idTestInstance(),
                    '',
                    'An Id\'s length must be less than or equal to 80'
                )
            );
        }
    }

}

