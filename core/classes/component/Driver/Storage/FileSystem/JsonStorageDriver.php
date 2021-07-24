<?php


namespace roady\classes\component\Driver\Storage\FileSystem;

use roady\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonBase;
use roady\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonInterface;

class JsonStorageDriver extends JsonBase implements JsonInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the JsonBase class
     * fulfills the requirements of the JsonInterface.
     */
}
