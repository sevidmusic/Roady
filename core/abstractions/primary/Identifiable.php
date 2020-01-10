<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\dev\traits\Logger;
use DarlingCms\interfaces\primary\Identifiable as IdentifiableInterface;
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

    private $name;

    private $uniqueId;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->uniqueId = $this->generateUniqueId();
    }

    private function generateUniqueId(): string
    {
        try {
            return preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(512));
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
