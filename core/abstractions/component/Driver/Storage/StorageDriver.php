<?php

namespace roady\abstractions\component\Driver\Storage;

use roady\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverBase;
use roady\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use roady\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

abstract class StorageDriver extends JsonStorageDriverBase implements StandardStorageDriverInterface, JsonStorageDriverInterface
{

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
