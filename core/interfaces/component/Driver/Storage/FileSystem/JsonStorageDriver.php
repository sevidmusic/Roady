<?php

namespace DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem;


use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

interface JsonStorageDriver extends StorageDriverInterface
{

    public const STORAGE_DIRECTORY_NAME = 'dcmsJsonData96597444';

    public function getStorageDirectoryPath(): string;

    public function getStoragePath(StorableInterface $storable): string;

}
