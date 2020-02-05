<?php

namespace DarlingCms\interfaces\component\Driver\Storage\FileSystem;


use DarlingCms\interfaces\component\Driver\Storage\Base as StorageDriverInterface;
use DarlingCms\interfaces\primary\Storable;

interface Json extends StorageDriverInterface
{

    public function getStorageDirectoryPath(): string;

    public function getStoragePath(Storable $storable): string;

}
