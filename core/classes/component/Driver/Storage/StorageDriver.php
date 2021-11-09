<?php

namespace roady\classes\component\Driver\Storage;

use roady\abstractions\component\Driver\Storage\StorageDriver as StorageDriverAbstraction;
use roady\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;

/**
 *
 * @devNote This class utilizes the JsonStorageDriver
 *          implementation of the StorageDriver interface
 *          to actually perform its operations.
 *
 *          If you find yourself tempted to use this class in
 *          a roady App, use the JsonStorageDriver instead.
 *
 */
class StorageDriver extends StorageDriverAbstraction implements StorageDriverInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StandardBase class
     * fulfills the requirements of the StandardInterface.
     */
}
