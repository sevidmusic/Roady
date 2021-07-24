<?php


namespace roady\classes\component\Registry\Storage;

use roady\abstractions\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryBase;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

class StoredComponentRegistry extends StoredComponentRegistryBase implements StoredComponentRegistryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StoredComponentRegistryBase class
     * fulfills the requirements of the StoredComponentRegistryInterface.
     */
}