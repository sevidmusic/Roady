<?php

namespace roady\classes\strings;

use roady\classes\strings\Text;
use roady\interfaces\strings\SafeText as SafeTextInterface;
use roady\interfaces\strings\Text as TextInterface;

class SafeText extends Text implements SafeTextInterface
{

    /**
     * Instantiate a new SafeText instance using the specified Text.
     *
     * @param TextInterface $text The Text to construct the SafeText
     *                            from.
     *
     * @example
     *
     * ```
     * $safeText = new SafeText(new Text('Foo Bar Baz'));
     *
     * echo $safeText;
     * // example output: Foo_Bar_Baz
     *
     * ```
     *
     * @see TextInterface
     *
     */
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
     * - Alphanumeric characters: A-Z, a-z, and 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * Unsafe characters will be replace with underscores.
     *
     * A consecutive sequence of 2 or more unsafe characters will be
     * replaced by a single underscore.
     *
     * Consequently, a consecutive sequence of 2 or more underscores
     * will also be replaced by a single underscore.
     *
     * If the original string is empty, then the modified string will
     * be the numeric character 0.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!(#(FJD(%F{{}|F"?F>>F<FIEI<DQ((#}}|}"D:O@MC(';
     *
     * echo $this->makeStringSafe($string);
     * // example output: _FJD_F_F_F_F_FIEI_DQ_D_O_MC_
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
        $safeChars = preg_replace('/[^A-Za-z0-9_-]/', '_', $string);
        $safeChars = preg_replace('#_+#', '_', ($safeChars ?? ''));
        return strval(
            empty($safeChars)
            ? 0
            : $safeChars
        );
    }
}

