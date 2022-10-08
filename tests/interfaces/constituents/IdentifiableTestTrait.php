<?php

namespace tests\interfaces\constituents;

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
     * @var Name $expectedName The Name that is expected to be
     *                         assigned to the Identifiable
     *                         implementation instance being tested.
     */
    private Name $expectedName;

    /**
     * @var Id $expectedId The Id that is expected to be assigned to
     *                     the Identifiable implementation instance
     *                     being tested.
     */
    private Id $expectedId;

    /**
     * @var Identifiable $identifiable
     *                              An instance of a
     *                              Identifiable
     *                              implementation to test.
     */
    protected Identifiable $identifiable;

    /**
     * Return the Identifiable implementation instance to test.
     *
     * @return Identifiable
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
     */
    protected function setIdentifiableTestInstance(
        Identifiable $identifiableTestInstance
    ): void
    {
        $this->identifiable = $identifiableTestInstance;
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
     */
    public function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
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
     */
    public function setExpectedId(Id $id): void
    {
        $this->expectedId = $id;
    }

    /**
     * Return the Name that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @return Name
     *
     */
    public function expectedName(): Name
    {
        return $this->expectedName;
    }

    /**
     * Return the Id that is expected to be assigned to the
     * Identifiable implementation instance being tested.
     *
     * @return Id
     *
     */
    public function expectedId(): Id
    {
        return $this->expectedId;
    }

    /**
     * Test the Name() method returns the expected Name.
     *
     * @return void
     *
     */
    public function testNameReturnsExpectedName(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->identifiableTestInstance()->name(),
            'The ' .
            $this->identifiableTestInstance()::class .
            '\'s name() method must return the expected Name.'
        );
    }

    /**
     * Test the id() method returns the expected Id.
     *
     * @return void
     *
     */
    public function testIdReturnsExpectedName(): void
    {
        $this->assertEquals(
            $this->expectedId(),
            $this->identifiableTestInstance()->id(),
            'The ' .
            $this->identifiableTestInstance()::class .
            '\'s id() method must return the expected Id.'
        );
    }

    /**
     * Test the type() method returns an appropriate ClassString for
     * the Identifiable instance being tested.
     *
     * @return void
     *
     */
    public function testTypeReturnsExpectedClassString(): void
    {
        $this->assertEquals(
            $this->identifiableTestInstance()::class,
            $this->identifiableTestInstance()->type(),
            'The ' .
            $this->identifiableTestInstance()::class .
            '\'s type() method must return the expected ClassString.'
        );
    }

}

