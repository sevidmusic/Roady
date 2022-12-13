<?php

namespace tests\interfaces\strings;

use roady\classes\strings\UnknownClass as UnknownClassString;
use roady\interfaces\strings\UnknownClass;
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
     * @var UnknownClass $unknownClass An instance of a UnknownClass
     *                                 implementation to test.
     */
    protected UnknownClass $unknownClass;

    /**
     * Return the UnknownClass implementation instance to test.
     *
     * @return UnknownClass
     *
     * @example
     *
     * ```
     * echo $this->unknownClassTestInstance();
     * // example output: roady\classes\strings\UnknownClass
     *
     * ```
     *
     */
    protected function unknownClassTestInstance(): UnknownClass
    {
        return $this->unknownClass;
    }

    /**
     * Set the UnknownClass implementation instance to test.
     *
     * @param UnknownClass $unknownClassTestInstance An instance of
     *                                               an implementation
     *                                               of the
     *                                               UnknownClass
     *                                               interface to
     *                                               test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setUnknownClassTestInstance(
     *     new \roady\classes\strings\UnknownClass()
     * );
     *
     * ```
     *
     */
    protected function setUnknownClassTestInstance(
        UnknownClass $unknownClassTestInstance
    ): void
    {
        $this->unknownClass = $unknownClassTestInstance;
    }

    /**
     * Overrides parent method:
     *
     * ClassString::test___toString_returns_the_fully_qualified_class_name_of_the_expected_class.
     *
     * An UnknownClass implementation's __toString() method must
     * return it's own fully qualified classname.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_fully_qualified_class_name_of_the_expected_class(): void
    {
        $expectedClass = $this->unknownClassTestInstance()::class;
        $this->setUpWithSpecifiedClass($expectedClass);
        $this->assertEquals(
            $expectedClass,
            $this->classStringTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->classStringTestInstance(),
                '__toString',
                'return ' . $expectedClass
            )
        );
    }
}

