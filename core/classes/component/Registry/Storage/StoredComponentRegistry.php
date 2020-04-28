<?php


namespace DarlingCms\classes\component\Registry\Storage;

use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingCms\abstractions\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryBase;

class StoredComponentRegistry extends StoredComponentRegistryBase implements StoredComponentRegistryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StoredComponentRegistryBase class
     * fulfills the requirements of the StoredComponentRegistryInterface.
     */
}