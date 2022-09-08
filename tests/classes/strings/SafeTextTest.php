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

    /**
     * Default setup using randomly generated Text.
     *
     * @return void
     *
     */
    protected function setUp(): void
    {
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText($this->randomChars())
        );
    }

    /**
     * Setup for tests that expect original Text to be an
     * empty string.
     *
     * @return void
     *
     */
    protected function setUpWithEmptyString(): void
    {
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText('')
        );
    }

    /**
     * Set up using the specified Text.
     *
     * @param Text $text The text to use for set up.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setUpWithSpecificText(
     *     new TextToBeRepresentedBySafeText('Foo Bar Baz')
     * );
     *
     * $this->assertEquals(
     *     'Foo_Bar_Baz',
     *     $this->safeTextTestInstance()
     * );
     *
     * ```
     *
     * @see Text
     *
     */
    protected function setUpWithSpecificText(Text $text): void
    {
        $safeText = new SafeText($text);
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
        $this->setExpectedString($this->makeStringSafe($text));
    }

}
