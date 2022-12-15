<?php

namespace tests\classes\constituents;

use roady\classes\constituents\Identifiable;
use roady\classes\strings\Id;
use roady\classes\strings\Name;
use roady\classes\strings\Text;
use tests\RoadyTest;
use tests\interfaces\constituents\IdentifiableTestTrait;

/**
 * Test case for the roady\classes\strings\Identifiable implementation
 * of the roady\interfaces\strings\Identifiable interface.
 *
 */
class IdentifiableTest extends RoadyTest
{

    /**
     * The IdentifiableTestTrait defines common tests for
     * implementations of the
     * roady\interfaces\constituents\Identifiable interface.
     *
     * @see IdentifiableTestTrait
     *
     */
    use IdentifiableTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(
            new Text('Name' . strval(rand(1000, 10000)))
        );
        $expectedId = new Id();
        $this->setExpectedName($expectedName);
        $this->setExpectedId($expectedId);
        $this->setIdentifiableTestInstance(
            new Identifiable(
                $expectedName,
                $expectedId,
            )
        );
    }

}
