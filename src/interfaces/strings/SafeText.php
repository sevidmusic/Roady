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
 * Unsafe characters in the original Text will be replaced with
 * underscores.
 *
 * A consecutive sequence of 2 or more unsafe characters will be
 * replaced by a single underscore.
 *
 * Consequently, a consecutive sequence of 2 or more underscores
 * will also be replaced by a single underscore.
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
 * // example output: !(#(FJD(%F{{}|F"?F>>F<FIEI<DQ((#}}|}"D:O@7A(
 *
 * echo strval($safeText->originalText()->length());
 * // example output: 44
 *
 * echo $safeText;
 * // example output: _FJD_F_F_F_F_FIEI_DQ_D_O_7A_
 *
 * echo strval($safeText->length());
 * // example output: 28
 *
 * echo $emptySafeText->originalText();
 * // example output:
 *
 * echo strval($emptySafeText->originalText()->length());
 * // example output: 0
 *
 * echo $emptySafeText;
 * // example output: 0
 *
 * echo strval($emptySafeText->length());
 * // example output: 1
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
     * // example output: !(#(FJD(%F{{}|F"?F>>F<FIEI<DQ((#}}|}"D:O@7A(
     *
     * echo $safeText;
     * // example output: _FJD_F_F_F_F_FIEI_DQ_D_O_7A_
     *
     * ```
     *
     * @see Text
     *
     */
    public function originalText(): Text;

}

