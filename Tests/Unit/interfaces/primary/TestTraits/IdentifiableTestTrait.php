<?php

namespace UnitTests\interfaces\primary\TestTraits;

use roady\interfaces\primary\Identifiable;
use UnitTests\TestTraits\StringTester;

trait IdentifiableTestTrait
{

    use StringTester;

    private Identifiable $identifiable;

    public function testGetNameReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty(
            $this->getIdentifiable()->getName()
        );
    }

    protected function getIdentifiable(): Identifiable
    {
        return $this->identifiable;
    }

    protected function setIdentifiable(
        Identifiable $identifiable
    ): void
    {
        $this->identifiable = $identifiable;
    }

    public function testGetNameReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric(
            $this->getIdentifiable()->getName()
        );
    }

    public function testGetUniqueIdReturnsNonEmptyString(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty(
            $this->getIdentifiable()->getUniqueId()
        );
    }

    public function testGetUniqueIdReturnsAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric(
            $this->getIdentifiable()->getUniqueId()
        );
    }

    protected function getRandomTestName(): string
    {
        try {
            $badChars = [
                '!', '@', '#', '$', '%', '^', '&', '*',
                '(', ')', '-', '_', '='. '+', ',', '.'
            ];
            return bin2hex(
                random_bytes(12)
            ) . $badChars[array_rand($badChars)] . rand(10, 1000);
        } catch (\Exception $e) {
            return 'auijkdf' . rand(100, 1000) . 
                'UIO N*UD_(UIH*9u (*&^';
        }
    }
}
