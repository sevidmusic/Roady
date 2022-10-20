<?php

namespace tests\interfaces\strings;

use roady\classes\strings\Text as TextToConvertToAName;
use tests\interfaces\strings\SafeTextTestTrait;
use roady\interfaces\strings\Name;

/**
 * The NameTestTrait defines common tests for implementations of the
 * Name interface.
 *
 * @see Name
 *
 */
trait NameTestTrait
{
    /**
     * The SafeTextTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\SafeText interface.
     *
     * @see roady\interfaces\strings\SafeText
     */
    use SafeTextTestTrait;

    /**
     * @var Name $name An instance of an implementation of the Name
     *                 interface to test.
     */
    private Name $name;

    /**
     * Modify a string, insuring only the following characters
     * exist in the resulting string:
     *
     * - Alphanumeric characters: A-Z, a-z, and 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * Unsafe characters will be replaced with underscores.
     *
     * A consecutive sequence of 2 or more unsafe characters will be
     * replaced by a single underscore.
     *
     * A consecutive sequence of 2 or more underscores will be
     * replaced by a single underscore.
     *
     * A consecutive sequence of 2 or more hyphens will be replaced by
     * a single hyphen.
     *
     * A consecutive sequence of 2 or more periods will be replaced by
     * a single period.
     *
     * If the original string is empty, then the modified string will
     * be the numeric character: 0
     *
     * Finally, the resulting string will always start with an
     * alphanumeric character.
     *
     * If the original string does not contain any alphanumeric
     * characters than the modified string will be the numeric
     * character: 0
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo Bar Baz..Bin!@#Bar--Foo____%$#@#$%^&*Bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: Foo_Bar_Baz.Bin_Bar-Foo_Bazzer
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '_';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '-';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '.';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '(#$*%*';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $string = parent::makeStringSafe($string);
        $string = substr(
            $string,
            $this->positionOfFirstAlphanumericCharacter($string),
            70
        );
        return match(
            empty($string) ||
            $string === '_' ||
            $string === '-' ||
            $string === '.'
        ) {
            true => strval(0),
            default => $string
        };
    }

    /**
     * Return the implementation of the Name interface to test.
     *
     * @return Name
     *
     * @see Name
     *
     */
    public function nameTestInstance(): Name
    {
        return $this->name;
    }

    /**
     * Determine the position of the first alphanumeric character
     * in a string.
     *
     * @return int
     *
     */
    protected function positionOfFirstAlphanumericCharacter(
        string $string
    ): int
    {
        $stringLength = mb_strlen($string);
        for(
            $firstAlphanumericCharacterIndex = 0;
            $firstAlphanumericCharacterIndex < $stringLength;
            $firstAlphanumericCharacterIndex++
        ) {
            if(
                ctype_alnum(
                    $string[$firstAlphanumericCharacterIndex]
                )
            ) {
                break;
            };
        }
        return $firstAlphanumericCharacterIndex;
    }

    /**
     * Set an instance of an implementation of the Name interface
     * to test.
     *
     * @return void
     *
     * @see Name
     *
     */
    public function setNameTestInstance(Name $name): void
    {
        $this->name = $name;
    }

    /**
     * Test that a Name always begins with an alphanumeric character.
     *
     * @return void
     *
     */
    public function test_Name_always_begins_with_an_alphanumeric_character(): void
    {
        $text = new TextToConvertToAName(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertTrue(
            ctype_alnum(substr($this->nameTestInstance(), 0, 1)),
            'The ' .
            get_class($this->nameTestInstance()) .
            ' implementation must insure that the Name always ' .
            'starts with an alphanumeric character.'
        );
    }


    /**
     * Test that the length of a Name is always less than 71.
     *
     * @return void
     *
     */
    public function test_that_the_length_of_a_Name_is_always_less_than_71(): void
    {
        $text = new TextToConvertToAName(
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1' .
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertLessThan(
            71,
            $this->nameTestInstance()->length(),
            'The ' .
            get_class($this->nameTestInstance()) .
            ' implementation must insure that the Name\'s length ' .
            'is less than 71 even if the original Text\'s length ' .
            'was greater than 71'
        );
    }

    /**
     * Test that the length of a Name is always at least 1.
     *
     * @return void
     *
     */
    public function test_that_the_length_of_a_Name_is_always_at_least_1(): void
    {
        $strings = ['', '.', '-', '_', $this->randomChars()];
        $text = new TextToConvertToAName(
            $strings[array_rand($strings)]
        );
        $this->setUpWithSpecificText($text);
        $this->assertGreaterThan(
            0,
            $this->nameTestInstance()->length(),
            'The ' .
            get_class($this->nameTestInstance()) .
            ' implementation must insure that the Name\'s length ' .
            'is at least 1.'
        );
    }
}