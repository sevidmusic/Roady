<?php

namespace DarlingDataManagementSystem\abstractions\component\Driver\Storage;

use DarlingDataManagementSystem\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverBase;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class StorageDriver extends JsonStorageDriverBase implements StandardStorageDriverInterface, JsonStorageDriverInterface
{

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
