<?php

namespace DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem;


use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StandardStorageDriver as StorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable;

interface Json extends StorageDriverInterface
{

    public function getStorageDirectoryPath(): string;

    public function getStoragePath(Storable $storable): string;

}
