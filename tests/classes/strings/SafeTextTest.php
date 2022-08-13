<?php

namespace tests\classes\strings;

use roady\classes\strings\SafeText;
use roady\classes\strings\Text as TextToBeRepresentedBySafeText;
use roady\interfaces\strings\Text as Text;
use tests\classes\strings\TextTest;
use tests\interfaces\strings\SafeTextTestTrait;

class SafeTextTest extends TextTest
{

    use SafeTextTestTrait;

    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText($string)
        );
    }

    protected function setUpWithEmptyString(): void
    {
        $this->setUpWithSpecificText(
            new TextToBeRepresentedBySafeText('')
        );
    }

    protected function setUpWithSpecificText(Text $text): void
    {
        $safeText = new SafeText($text);
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
        $this->setExpectedString($this->makeStringSafe($text));
    }

}
