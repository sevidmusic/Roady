<?php

namespace roady\interfaces\component\Driver\Storage\FileSystem;


use roady\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;
use roady\interfaces\primary\Storable as StorableInterface;

interface JsonStorageDriver extends StorageDriverInterface
{

    public const STORAGE_DIRECTORY_NAME = 'dcmsJsonData';

    public function getStorageDirectoryPath(): string;

    public function getStoragePath(StorableInterface $storable): string;

}
