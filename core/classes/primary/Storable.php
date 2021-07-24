<?php

namespace roady\classes\primary;

use roady\abstractions\primary\Storable as StorableBase;
use roady\interfaces\primary\Storable as StorableInterface;

class Storable extends StorableBase implements StorableInterface
{

    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StorableBase class
     * fulfills the requirements of the StorableInterface.
     */
}
