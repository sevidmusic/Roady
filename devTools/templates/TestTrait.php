<?php

namespace tests\interfaces\__SUB_NAMESPACE__;

use roady\interfaces\__SUB_NAMESPACE__\__TARGET_CLASS_NAME__;

/**
 * The __TARGET_CLASS_NAME__TestTrait defines common tests for
 * implementations of the __TARGET_CLASS_NAME__ interface.
 *
 * @see __TARGET_CLASS_NAME__
 *
 */
trait __TARGET_CLASS_NAME__TestTrait
{

    /**
     * @var __TARGET_CLASS_NAME__ $__LC_TARGET_CLASS_NAME__
     *                              An instance of a
     *                              __TARGET_CLASS_NAME__
     *                              implementation to test.
     */
    protected __TARGET_CLASS_NAME__ $__LC_TARGET_CLASS_NAME__;

    /**
     * Return the __TARGET_CLASS_NAME__ implementation instance to test.
     *
     * @return __TARGET_CLASS_NAME__
     *
     */
    protected function __LC_TARGET_CLASS_NAME__TestInstance(): __TARGET_CLASS_NAME__
    {
        return $this->__LC_TARGET_CLASS_NAME__;
    }

    /**
     * Set the __TARGET_CLASS_NAME__ implementation instance to test.
     *
     * @param __TARGET_CLASS_NAME__ $__LC_TARGET_CLASS_NAME__TestInstance
     *                              An instance of an
     *                              implementation of
     *                              the __TARGET_CLASS_NAME__
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function set__TARGET_CLASS_NAME__TestInstance(
        __TARGET_CLASS_NAME__ $__LC_TARGET_CLASS_NAME__TestInstance
    ): void
    {
        $this->__LC_TARGET_CLASS_NAME__ = $__LC_TARGET_CLASS_NAME__TestInstance;
    }

}

