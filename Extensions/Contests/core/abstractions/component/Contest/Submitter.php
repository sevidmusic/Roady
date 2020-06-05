<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use Extensions\Contests\core\interfaces\component\Contest\Submitter as SubmitterInterface;
use RuntimeException;

abstract class Submitter extends Component implements SubmitterInterface
{

    private $email;

    public function __construct(Storable $storable, string $email)
    {
        parent::__construct($storable);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Warning: Invalid email supplied to Submitter with name ' . $this->getName() . '  and  id ' . $this->getUniqueId());
        }
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
