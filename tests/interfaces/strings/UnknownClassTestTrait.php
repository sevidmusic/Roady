<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\UnknownClass;
use roady\classes\strings\UnknownClass as UnknownClassString;
use tests\interfaces\strings\ClassStringTestTrait;

/**
 * The UnknownClassTestTrait defines common tests for
 * implementations of the UnknownClass interface.
 *
 * @see UnknownClass
 *
 */
trait UnknownClassTestTrait
{

    /**
     * The ClassStringTestTrait defines common tests for
     * implementations of the roady\interfaces\strings\ClassString
     * interface.
     */
    use ClassStringTestTrait;

    /**
     * @var UnknownClass $unknownClass
     *                              An instance of a
     *                              UnknownClass
     *                              implementation to test.
     */
    protected UnknownClass $unknownClass;

    /**
     * Return the UnknownClass implementation instance to test.
     *
     * @return UnknownClass
     *
     */
    protected function unknownClassTestInstance(): UnknownClass
    {
        return $this->unknownClass;
    }

    /**
     * Set the UnknownClass implementation instance to test.
     *
     * @param UnknownClass $unknownClassTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the UnknownClass
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setUnknownClassTestInstance(
        UnknownClass $unknownClassTestInstance
    ): void
    {
        $this->unknownClass = $unknownClassTestInstance;
    }

    /**
     * Overrides ClassString::test___toString_returns_the_fully_qualified_class_name_of_the_expected_class.
     *
     * An UnknownClass implementation's __toString() method must
     * return UnknownClassString::class.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_fully_qualified_class_name_of_the_expected_class(): void
    {
        $expectedClass = UnknownClassString::class;
        $this->setUpWithSpecifiedClass($expectedClass);
        $this->assertEquals(
            $expectedClass,
            $this->classStringTestInstance()->__toString(),
            'The ' . get_class($this->classStringTestInstance()) .
            '\'s __toString() method must return ' . $expectedClass
        );
    }
}

