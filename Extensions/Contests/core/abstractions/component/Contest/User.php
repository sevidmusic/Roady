<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingDataManagementSystem\abstractions\component\Component;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use Extensions\Contests\core\interfaces\component\Contest\User as UserInterface;
use RuntimeException;

abstract class User extends Component implements UserInterface
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
                    "Warning: Invalid email %s assigned to User with name %s  and  id %s",
                    $this->email,
                    $this->getName(),
                    $this->getUniqueId()
                )
            );
        }
        return $this->email;
    }
}
