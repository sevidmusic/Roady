<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\AlphanumericText;
use tests\interfaces\strings\SafeTextTestTrait;

/**
 * The AlphanumericTextTestTrait defines common tests for
 * implementations of the AlphanumericText interface.
 *
 * @see AlphanumericText
 *
 */
trait AlphanumericTextTestTrait
{

    use SafeTextTestTrait;

    /**
     * @var AlphanumericText $alphanumericText An instance of a
     *                                         AlphanumericText
     *                                         implementation to
     *                                         test.
     */
    protected AlphanumericText $alphanumericText;

    /**
     * Return the AlphanumericText implementation instance to test.
     *
     * @return AlphanumericText
     *
     */
    protected function alphanumericTextTestInstance(): AlphanumericText
    {
        return $this->alphanumericText;
    }

    /**
     * Set the AlphanumericText implementation instance to test.
     *
     * @param AlphanumericText $alphanumericTextTestInstance
     *                                           An instance of an
     *                                           implementation of
     *                                           the AlphanumericText
     *                                           interface to test.
     *
     * @return void
     *
     */
    protected function setAlphanumericTextTestInstance(
        AlphanumericText $alphanumericTextTestInstance
    ): void
    {
        $this->alphanumericText = $alphanumericTextTestInstance;
    }


    /**
     * Test __toString() returns an alphanumeric string.
     *
     * @return void
     *
     */
    public function test__toStringReturnsAnAlphanumericString(): void
    {
        $this->assertTrue(
            ctype_alnum(
                $this->alphanumericTextTestInstance()->__toString()
            ),
            $this->alphanumericTextTestInstance()::class .
            '\'s __toString() method must return a string that only' .
            'contains alphanumeric characters.'
        );
    }

    /**
     * Test __toString() returns an alphanumeric form of the
     * original Text.
     *
     * @return void
     *
     */
    public function test__toStringReturnsAnAlphanumericFormOfTheOriginalText(): void
    {
        $originalText = $this->alphanumericTextTestInstance()
                             ->originalText();
        $this->assertEquals(
            $this->makeStringSafe($originalText),
            $this->alphanumericTextTestInstance()->__toString(),
            'The ' .
            $this->alphanumericTextTestInstance()::class .
            'implementation\'s __toString() method must return ' .
            'an alphanumeric form of the original Text.'
        );
    }
    /**
     * Modify a string, insuring only alphanumeric characters
     * exist in the resulting string:
     *
     * If the original string is empty, then the modified string will
     * be the numeric character 0.
     *
     * If the original string does not contain any alphanumeric
     * characters, then the modified string will be the numeric
     * character 0.
     *
     * Also, the first letter of each alphanumeric word in the
     * original string will be capitalized in the resulting string.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo Bar Baz..Bin!@#Bar--foo____%$#@#$%^&*bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: FooBarBazBinBarFooBazzer
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $safeString = parent::makeStringSafe($string);
        $words = ucwords($safeString, '_-.');
        $alphanumericString = preg_replace(
            "/[^A-Za-z0-9 ]/",
            '',
            $words
        );
        return strval(
            empty($alphanumericString)
            ? 0
            : $alphanumericString
        );
    }
}

