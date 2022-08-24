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

    protected function makeStringSafe(string $string): string
    {
        $safeChars = preg_replace('/[^A-Za-z0-9\._-]/', '_', $string);
        $safeChars = preg_replace('#_+#', '_', ($safeChars ?? ''));
        $safeChars = preg_replace('#-+#', '-', ($safeChars ?? ''));
        $safeChars = preg_replace('#\.+#', '.', ($safeChars ?? ''));
        return strval(
            empty($safeChars)
            ? 0
            : $safeChars
        );
    }
}

