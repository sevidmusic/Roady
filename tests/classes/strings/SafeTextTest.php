<?php

namespace tests\classes\strings;

use roady\classes\strings\SafeText;
use roady\classes\strings\Text as TextImplmentationToUseForTesting;
use roady\interfaces\strings\Text as Text;
use tests\classes\strings\TextTest;
use tests\interfaces\strings\SafeTextTestTrait;

class SafeTextTest extends TextTest
{

    use SafeTextTestTrait;

    /**
     * Set up a SafeText instance for testing using a randomly
     * generated string.
     *
     * Note:This method will be called before each test is run.
     *
     * @return void
     *
     * @see https://phpunit.readthedocs.io/en/9.5/fixtures.html
     *
     */
    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($this->makeStringSafe($string));
        $safeText = new SafeText(new TextImplmentationToUseForTesting($string));
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

    /**
     *
     */
    protected function setUpWithEmptyString(): void
    {
        $this->setExpectedString('0');
        $safeText = new SafeText(new TextImplmentationToUseForTesting(''));
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

    /**
     *
     */
    protected function setUpWithSpecificText(Text $text): void
    {
        $this->setExpectedString($this->makeStringSafe($text));
        $safeText = new SafeText($text);
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

}
