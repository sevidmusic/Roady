<?php

namespace tests\classes\strings;

use roady\classes\strings\Name;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\NameTestTrait;

class NameTest extends SafeTextTest
{

    use NameTestTrait;

    protected function setUpWithSpecificText(Text $text): void
    {
        $name = new Name($text);
        $this->setTextTestInstance($name);
        $this->setSafeTextTestInstance($name);
        $this->setNameTestInstance($name);
        $this->setExpectedString($this->makeStringSafe($text));
    }

}
