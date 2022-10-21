<?php

namespace tests\interfaces\constituents;

use roady\classes\strings\ClassString;
use roady\interfaces\constituents\Identifiable;
use roady\interfaces\strings\Id;
use roady\interfaces\strings\Name;

/**
 * The IdentifiableTestTrait defines common tests for
 * implementations of the Identifiable interface.
 *
 * @see Identifiable
 *
 */
trait IdentifiableTestTrait
{

    /**
     * @var Id $expectedId The Id that is expected to be assigned to
     *                     the Identifiable implementation instance
     *                     being tested.
     */
    private Id $expectedId;

    /**
     * @var Name $expectedName The Name that is expected to be
     *                         assigned to the Identifiable
     *                         implementation instance being tested.
     */
    private Name $expectedName;

    /**
     * @var Identifiable $identifiable An instance of an Identifiable
     *                                 implementation to test.
     */
    protected Identifiable $identifiable;

    /**
     * Return the Identifiable implementation instance to test.
     *
     * @return Identifiable
     *
     * @example
     *
     * ```
     * echo $this->identifiableTestInstance()->type();
     * // roady\classes\constituents\Identifiable
     *
     * ```
     *
     */
    protected function identifiableTestInstance(): Identifiable
    {
        return $this->identifiable;
    }

    /**
     * Set the Identifiable implementation instance to test.
     *
     * @param Identifiable $identifiableTestInstance An instance of
     *                                               an implementation
     *                                               of the
     *                                               Identifiable
     *                                               interface to
     *                                               test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setIdentifiableTestInstance(
     *     new roady\classes\constituents\Identifiable(
     *         new roady\classes\strings\Name(
     *             new roady\classes\strings\Text('Name')
     *         ),
     *         new roady\classes\strings\Id()
     *     )
     * );
     *
     * ```
     *
     */
    protected function setIdentifiableTestInstance(
        Identifiable $identifiableTestInstance
    ): void
    {
        $this->identifiable = $identifiableTestInstance;
    }

    /**
     * Return the Id that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @return Id
     *
     * @example
     *
     * ```
     * echo $this->expectedId();
     *
     * // example output:
     * P5ANEmDAaUDXtayGiT2b6dVXz5hmCrVfVPBCsbu8zpUq3AetPYixuYWWOn3RZT2l
     *
     * ```
     *
     */
    public function expectedId(): Id
    {
        return $this->expectedId;
    }

    /**
     * Return the Name that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @return Name
     *
     * @example
     *
     * ```
     * echo $this->expectedName();
     * // example output: Name
     *
     * ```
     *
     */
    public function expectedName(): Name
    {
        return $this->expectedName;
    }

    /**
     * Set the Id that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @param Id $id The Id that is expected to be assigned to
     *               the Identifiable implementation instance
     *               being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setExpectedId(new roady\classes\strings\Id());
     *
     * ```
     *
     */
    public function setExpectedId(Id $id): void
    {
        $this->expectedId = $id;
    }

    /**
     * Set the Name that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @param Name $name The Name that is expected to be assigned to
     *                   the Identifiable implementation instance
     *                   being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setExpectedName(
     *     new roady\classes\strings\Name(
     *         new roady\classes\strings\Text('Name'),
     *     )
     * );
     *
     * ```
     *
     *
     */
    public function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
    }

    /**
     * Test that the id() method returns the expected Id.
     *
     * @return void
     *
     */
    public function testIdReturnsExpectedId(): void
    {
        $this->assertEquals(
            $this->expectedId(),
            $this->identifiableTestInstance()->id(),
            $this->testFailedMessage(
                $this->identifiableTestInstance(),
                'id',
                'return the expected Id'
            )
        );
    }

    /**
     * Test that the name() method returns the expected Name.
     *
     * @return void
     *
     */
    public function testNameReturnsExpectedName(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->identifiableTestInstance()->name(),
            $this->testFailedMessage(
                $this->identifiableTestInstance(),
                'name',
                'return the expected Name'
            )
        );
    }

    /**
     * Test that the type() method returns an appropriate ClassString.
     *
     * @return void
     *
     */
    public function testTypeReturnsAnAppropriateClassString(): void
    {
        $this->assertEquals(
            new ClassString($this->identifiableTestInstance()),
            $this->identifiableTestInstance()->type(),
            $this->testFailedMessage(
                $this->identifiableTestInstance(),
                'type',
                'return an appropriate ClassString'
            )
        );
    }

}

