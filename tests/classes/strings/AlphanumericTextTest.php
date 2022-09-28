<?php

namespace tests\classes\strings;

use roady\classes\strings\AlphanumericText;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\AlphanumericTextTestTrait;
use tests\classes\strings\SafeTextTest;

class AlphanumericTextTest extends SafeTextTest
{

    /**
     * The AlphanumericTextTestTrait defines
     * common tests for implementations of the
     * roady\interfaces\strings\AlphanumericText
     * interface.
     *
     * @see AlphanumericTextTestTrait
     *
     */
    use AlphanumericTextTestTrait;

    /**
     * Set up using the specified Text.
     *
     * @param Text $text The text to use for set up.
     *
     * @return void
     *
     * @see Text
     *
     */
    protected function setUpWithSpecificText(Text $text): void
    {
        $alphanumericText = new AlphanumericText($text);
        $this->setTextTestInstance($alphanumericText);
        $this->setSafeTextTestInstance($alphanumericText);
        $this->setAlphanumericTextTestInstance($alphanumericText);
        $this->setExpectedString($this->makeStringSafe($text));
    }
}

