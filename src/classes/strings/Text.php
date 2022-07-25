<?php

namespace roady\classes\strings;

use roady\interfaces\strings\Text as TextInterface;
use \Stringable;

class Text implements TextInterface
{

    public function __construct(private string $string) {}

    public function __toString(): string
    {
        return $this->string;
    }

    public function contains(string|Text|Stringable ...$string): bool
    {
        return false;
    }

    public function length(): int
    {
        return 0;
    }
}

