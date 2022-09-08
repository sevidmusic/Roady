<?php

namespace tests\classes\strings;

use roady\classes\strings\Name;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\NameTestTrait;

class NameTest extends SafeTextTest
{
    use NameTestTrait;

    /**
     * Set up using the specified Text.
     *
     * @param Text $text The text to use for set up.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setUpWithSpecificText(
     *     new TextToBeRepresentedBySafeText('!Foo--Bar..Baz')
     * );
     *
     * $this->assertEquals(
     *     'Foo-Bar.Baz',
     *     $this->safeTextTestInstance()
     * );
     *
     * ```
     *
     * @see Text
     *
     */
    protected function setUpWithSpecificText(Text $text): void
    {
        $name = new Name($text);
        $this->setTextTestInstance($name);
        $this->setSafeTextTestInstance($name);
        $this->setNameTestInstance($name);
        $this->setExpectedString($this->makeStringSafe($text));
    }
}
