<?php

namespace roady\classes\strings;

use roady\interfaces\strings\Text as TextInterface;
use \Stringable;

class Text implements TextInterface
{

    /**
     * Instantiate a new Text instance.
     *
     * @param string $string The string the Text instance will
     *                       represent.
     *
     * @example
     *
     * ```
     * $text = new Text('Foo bar baz.');
     *
     * echo $text;
     * // example output: Foo bar baz.
     *
     * echo strval($text->length());
     * // example output: 12
     *
     * echo ($text->contains($text) ? 'True' : 'False');
     * // example output: True
     *
     *
     * ```
     *
     */
    public function __construct(private string $string) {}

    public function __toString(): string
    {
        return $this->string;
    }

    public function contains(string|Stringable ...$strings): bool
    {
        foreach($strings as $string) {
            if(!str_contains($this, $string)) {
                return false;
            }
        }
        return true;
    }

    public function length(): int
    {
        return mb_strlen($this->__toString());
    }

}

