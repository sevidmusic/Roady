<?php

namespace roady\abstractions\primary;

use roady\dev\traits\Logger;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use Exception;

abstract class Identifiable implements IdentifiableInterface
{

    use Logger;

    const RANDOM_BYTES_FAILED = <<<EOD
WARNING: Failed to generate unique id using random_bytes(), defaulting to
str_shuffle(). You can safely ignore this warning if the generated
id does not need to be cryptographically secure.
EOD;

    private string $uniqueId;

    public function __construct(private string $name)
    {
        $this->name = $this->removeNonAlphanumericCharacters($name);
        $this->uniqueId = $this->generateUniqueId();
    }

    private function generateUniqueId(): string
    {
        try {
            $uid = preg_replace(
                "/[^a-zA-Z0-9]+/", 
                "", 
                random_bytes(512)
            );
            return (
                is_string($uid) 
                ? $uid 
                : $this->generateRandomIdViaStrShuffle()
            );
        } catch (Exception $e) {
            return $this->generateRandomIdViaStrShuffle();
        }
    }

    private function generateRandomIdViaStrShuffle(): string
    {
            $this->log(self::RANDOM_BYTES_FAILED);
            $shuffledString = str_shuffle(
                'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'
            );
            return $shuffledString . str_shuffle($shuffledString);
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function removeNonAlphanumericCharacters(string $name): string
    {
        return strval(preg_replace('/[^a-z0-9]/i', '', $name));
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

}
