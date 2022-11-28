<?php

namespace tests\classes\strings;

use roady\classes\strings\SafeText;
use roady\classes\strings\Text as TextToBeRepresentedBySafeText;
use roady\interfaces\strings\Text as Text;
use tests\classes\strings\TextTest;
use tests\interfaces\strings\SafeTextTestTrait;

class SafeTextTest extends TextTest
{

    /**
     * The SafeTextTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\SafeText interface.
     *
     * @see SafeTextTestTrait
     *
     */
    use SafeTextTestTrait;

    protected function setUp(): void
    {
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText($this->randomChars())
        );
    }

    protected function setUpWithEmptyString(): void
    {
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText('')
        );
    }

    protected function setUpWithSpecificText(Text $text): void
    {
        $safeText = new SafeText($text);
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
        $this->setExpectedString($this->makeStringSafe($text));
    }

}
