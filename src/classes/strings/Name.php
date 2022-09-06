<?php

namespace roady\classes\strings;

use roady\classes\strings\SafeText;
use roady\interfaces\strings\Name as NameInterface;

class Name extends SafeText implements NameInterface
{

    protected function makeStringSafe(string $string): string
    {
        return substr(parent::makeStringSafe($string), 0, 70);
    }

}

