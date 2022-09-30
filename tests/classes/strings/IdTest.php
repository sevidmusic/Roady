<?php

namespace tests\classes\strings;

use roady\classes\strings\Id;
use tests\interfaces\strings\IdTestTrait;
use tests\classes\strings\AlphanumericTextTest;

class IdTest extends AlphanumericTextTest
{

    /**
     * The IdTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\Id interface.
     *
     * @see IdTestTrait
     *
     */
    use IdTestTrait;

    public function setUp(): void
    {
        $this->setUpWithNewInstance();
    }

    public function setUpWithNewInstance(): void
    {
        $id = new Id();
        $this->setTextTestInstance($id);
        $this->setSafeTextTestInstance($id);
        $this->setAlphanumericTextTestInstance($id);
        $this->setIdTestInstance($id);
        $this->setExpectedString($id);
    }

}

