<?php

namespace roady\classes\primary;

use roady\abstractions\primary\Identifiable as IdentifiableBase;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;

class Identifiable extends IdentifiableBase implements IdentifiableInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the IdentifiableBase class
     * fulfills the requirements of the IdentifiableInterface.
     */
}
