<?php

namespace DarlingCms\classes\primary;

use DarlingCms\abstractions\primary\Storable as StorableBase;
use DarlingCms\interfaces\primary\Storable as StorableInterface;

class Storable extends StorableBase implements StorableInterface
{

    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StorableBase class
     * fulfills the requirements of the StorableInterface.
     */
}
