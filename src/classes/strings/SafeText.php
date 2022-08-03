<?php

namespace roady\classes\strings;

use roady\interfaces\strings\Text as TextInterface;
use roady\interfaces\strings\SafeText as SafeTextInterface;
use roady\classes\strings\Text;

class SafeText extends Text implements SafeTextInterface
{

    public function __construct(private TextInterface $text)
    {
        parent::__construct($this->makeStringSafe($text));
    }

    public function originalText(): TextInterface
    {
        return $this->text;
    }

    /**
     * Modify a string, insuring only the following characters
     * exist in the resulting string:
     *
     * - Alphanumeric characters: A-Z, a-z, 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * All unsafe characters will be replaced with underscores.
     * If replacing unsafe characters with underscores results in a
     * string that does not start with an alphanumeric character, then
     * numeric character 0 will be prepended to the resulting string.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->makeStringSafe('!Foo&Bar(Baz');
     * // example output: 0_Foo_Bar_Baz
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $numericChar = strval(0);
        $safeChars = preg_replace('/[^A-Za-z0-9_-]/', '_', $string);
        $safeChars = preg_replace('#_+#', '_', ($safeChars ?? ''));
        return (
            empty($safeChars) || $safeChars === '_'
            ? $numericChar
            : (
                substr($safeChars, 0, 1) === '_'
                ? $numericChar . $safeChars
                : $safeChars
            )
        );
    }
}

