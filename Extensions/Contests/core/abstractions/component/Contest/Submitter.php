<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\abstractions\component\Component;
use DarlingCms\interfaces\primary\Storable;
use Extensions\Contests\core\interfaces\component\Contest\Submitter as SubmitterInterface;
use RuntimeException;

abstract class Submitter extends Component implements SubmitterInterface
{

    private $email;

    public function __construct(Storable $storable, string $email)
    {
        parent::__construct($storable);
        $this->email = $email;
    }

    public function getEmail(): string
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException(
                sprintf(
                    "Warning: Invalid email %s assigned to Submitter with name %s  and  id %s",
                    $this->email,
                    $this->getName(),
                    $this->getUniqueId()
                )
            );
        }
        return $this->email;
    }
}
