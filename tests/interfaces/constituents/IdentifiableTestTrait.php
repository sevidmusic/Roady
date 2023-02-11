<?php

namespace tests\interfaces\constituents;

use Darling\PHPTextTypes\classes\strings\ClassString;
use roady\interfaces\constituents\Identifiable;
use Darling\PHPTextTypes\interfaces\strings\Id;
use Darling\PHPTextTypes\interfaces\strings\Name;

/**
 * The IdentifiableTestTrait defines common tests for implementations
 * of the Identifiable interface.
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
    private Identifiable $identifiable;

    /**
     * Set up an Identifiable implementation instance to test.
     *
     * This method must set the Name that is expected to be assigned
     * to the Identifiable implementation instance to test via the
     * setExpectedName() method.
     *
     * This method must set the Id that is expected to be assigned
     * to the Identifiable implementation instance to test via the
     * setExpectedId() method.
     *
     * This method must set the Identifiable implementation instance
     * to test via the setIdentifiableTestInstance() method.
     *
     * This method may also perform any additional set up that may
     * be required.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void;
     * {
     *     $expectedName = new Darling\PHPTextTypes\classes\strings\Name(
     *         new Darling\PHPTextTypes\classes\strings\Text(
     *             'Name'
     *         )
     *     );
     *     $expectedId = new Darling\PHPTextTypes\classes\strings\Id();
     *     $this->setExpectedName($expectedName);
     *     $this->setExpectedId($expectedId);
     *     $this->setIdentifiableTestInstance(
     *         new \roady\classes\constituents\Identifiable(
     *             $expectedName,
     *             $expectedId,
     *         )
     *     );
     * }
     *
     * ```
     *
     */
    abstract public function setUp(): void;

    /**
     * Return the Identifiable implementation instance to test.
     *
     * @return Identifiable
     *
     * @example
     *
     * ```
     * $this->identifiableTestInstance();
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
     *     new \roady\classes\constituents\Identifiable(
     *         new \Darling\PHPTextTypes\classes\strings\Name(
     *             new \Darling\PHPTextTypes\classes\strings\Text('Name')
     *         ),
     *         new \Darling\PHPTextTypes\classes\strings\Id()
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
    protected function expectedId(): Id
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
    protected function expectedName(): Name
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
     * $this->setExpectedId(new \Darling\PHPTextTypes\classes\strings\Id());
     *
     * ```
     *
     */
    protected function setExpectedId(Id $id): void
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
     *     new \Darling\PHPTextTypes\classes\strings\Name(
     *         \new Darling\PHPTextTypes\classes\strings\Text('Name'),
     *     )
     * );
     *
     * ```
     *
     */
    protected function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
    }

    /**
     * Test that the id() method returns the expected Id.
     *
     * @return void
     *
     */
    public function test_id_returns_expected_id(): void
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
    public function test_name_returns_expected_name(): void
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
    public function test_type_returns_an_appropriate_class_string(): void
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

