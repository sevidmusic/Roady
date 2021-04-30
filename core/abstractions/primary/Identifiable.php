<?php

namespace DarlingDataManagementSystem\abstractions\primary;

use DarlingDataManagementSystem\dev\traits\Logger;
use DarlingDataManagementSystem\interfaces\primary\Identifiable as IdentifiableInterface;
use Exception;

abstract class Identifiable implements IdentifiableInterface
{

    use Logger;

    const RANDOM_BYTES_FAILED = <<<EOD
Identifiable Implementation Warning:
Failed to generate unique id using random_bytes(), defaulting to
str_shuffle(). You can safely ignore this warning if the generated
id does not need to be cryptographically secure.
EOD;

    private string $name;

    private string $uniqueId;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->uniqueId = $this->generateUniqueId();
    }

    private function generateUniqueId(): string
    {
        try {
            $uid = preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(512));
            return (is_string($uid) ? $uid : str_shuffle(strval(rand(PHP_INT_MIN, PHP_INT_MAX))));
        } catch (Exception $e) {
            $this->log(self::RANDOM_BYTES_FAILED);
        }
        return str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

}
