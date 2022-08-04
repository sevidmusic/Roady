<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\Text;

/**
 * SafeText is used to provide a safe form of Text that may contain
 * unsafe characters.
 *
 * The following characters are considered safe:
 *
 * - Alphanumeric characters: A-Z, a-z, and 0-9
 * - Underscores: _
 * - Hyphens: -
 * - Periods: .
 *
 * Any unsafe characters in the original Text will be replaced
 * with underscores.
 *
 * SafeText will always begin with an alphanumeric character.
 *
 * Note:
 *
 * If replacing the unsafe characters in the original Text with
 * underscores would result in a string that does not begin with
 * an alphanumeric character, then the numeric character 0 will
 * be prepended to the resulting SafeText.
 *
 * SafeText will never be empty, if the original Text is empty, then
 * the SafeText will be the numeric character 0.
 *
 * Methods:
 *
 * ```
 * public function originalText(): Text
 *
 * ```
 *
 * Methods inherited from Text:
 *
 * ```
 * public function __toString(): string;
 * public function contains(string|Stringable ...$strings): bool;
 * public function length(): int;
 *
 * ```
 *
 * @example
 *
 * ```
 * echo $safeText->originalText();
 * // example output: ^Foo$Bar*Baz%Bazzer!
 *
 * echo $safeText->originalText()->length();
 * // example output: 20
 *
 * echo $safeText;
 * // example output: 0_Foo_Bar_Baz_Bazzer_
 *
 * echo strval($safeText->length());
 * // example output: 21
 *
 * ```
 *
 * @see Text
 *
 */
interface SafeText extends Text
{

    /**
     * Returns the original Text, which may contain unsafe characters.
     *
     * @return Text
     *
     * @example
     *
     * ```
     * echo $safeText->originalText();
     * // example outpout: ^Foo$Bar*Baz%Bazzer!
     *
     * echo $safeText;
     * // example output: 0_Foo_Bar_Baz_Bazzer_
     *
     * ```
     *
     * @see Text
     *
     */
    public function originalText(): Text;

}

