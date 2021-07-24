<?php

namespace roady\classes\component\Factory;

use roady\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;

class StoredComponentFactory extends StoredComponentFactoryBase implements StoredComponentFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StoredComponentFactoryBase class
     * fulfills the requirements of the StoredComponentFactoryInterface.
     */
}