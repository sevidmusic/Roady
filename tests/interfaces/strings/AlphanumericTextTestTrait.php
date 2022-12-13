<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\AlphanumericText;
use roady\interfaces\strings\Text;
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

    /**
     * The SafeTextTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\SafeText interface.
     *
     */
    use SafeTextTestTrait;

    /**
     * @var AlphanumericText $alphanumericText An instance of an
     *                                         AlphanumericText
     *                                         implementation to
     *                                         test.
     */
    private AlphanumericText $alphanumericText;

    /**
     * Set up an AlphanumericText implementation instance for testing
     * using the specified Text.
     *
     * This method must call setTextTestInstance(),
     * setSafeTextTestInstance(), setAlphanumericTextTestInstance(),
     * and setExpectedString().
     *
     * This method must pass a version of the original Text that
     * was filtered via the makeStringSafe() method to the
     * setExpectedString() method.
     *
     * This method may also perform any additional set up that may
     * be required.
     *
     * @param Text $text The Text to use for set up.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithSpecificText(Text $text): void
     * {
     *     $alphanumericText =
     *         new \roady\classes\strings\AlphanumericText(
     *             $text
     *         );
     *     $this->setTextTestInstance($alphanumericText);
     *     $this->setSafeTextTestInstance($alphanumericText);
     *     $this->setAlphanumericTextTestInstance($alphanumericText);
     *     $this->setExpectedString($this->makeStringSafe($text));
     * }
     *
     * ```
     *
     * @see Text
     *
     */
    abstract protected function setUpWithSpecificText(Text $text): void;

    /**
     * Return the AlphanumericText implementation instance to test.
     *
     * @return AlphanumericText
     *
     * @example
     *
     * ```
     * echo $this->alphanumericTextTestInstance();
     * // example output: FooBarBaz123
     *
     * ```
     *
     */
    protected function alphanumericTextTestInstance(): AlphanumericText
    {
        return $this->alphanumericText;
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

    /**
     * Set the AlphanumericText implementation instance to test.
     *
     * @param AlphanumericText $alphanumericTextTestInstance
     *                                              An instance of an
     *                                              implementation of
     *                                              the
     *                                              AlphanumericText
     *                                              interface to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setAlphanumericTextTestInstance(
     *     new \roady\classes\strings\AlphanumericText(
     *         new \roady\classes\strings\Text('Foo Bar Baz'),
     *     )
     * );
     *
     * ```
     *
     */
    protected function setAlphanumericTextTestInstance(
        AlphanumericText $alphanumericTextTestInstance
    ): void
    {
        $this->alphanumericText = $alphanumericTextTestInstance;
    }

    /**
     * Test that the __toString() method returns an
     * alphanumeric string.
     *
     * @return void
     *
     */
    public function test__to_string_returns_an_alphanumeric_string(): void
    {
        $this->assertTrue(
            ctype_alnum(
                $this->alphanumericTextTestInstance()->__toString()
            ),
            $this->testFailedMessage(
                $this->alphanumericTextTestInstance(),
                '__toString',
                'return a string that only contains alphanumeric ' .
                'characters'
            )
        );
    }

    /**
     * Test that the __toString() method returns an alphanumeric
     * form of the original Text.
     *
     * @return void
     *
     */
    public function test__to_string_returns_an_alphanumeric_form_of_the_original_text(): void
    {
        $this->assertEquals(
            $this->makeStringSafe(
                $this->alphanumericTextTestInstance()->originalText()
            ),
            $this->alphanumericTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->alphanumericTextTestInstance(),
                '__toString',
                'return an alphanumeric form of the original Text'
            )
        );
    }

}

