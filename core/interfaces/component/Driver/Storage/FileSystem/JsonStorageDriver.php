<?php

namespace roady\interfaces\component\Driver\Storage\FileSystem;

use roady\interfaces\component\Driver\Storage\StorageDriver; 
use roady\interfaces\primary\Storable;

/**
 * A JsonStorageDriver is a StorageDriver that utilizes json
 * files for storage.
 * 
 * STORAGE_DIRECTORY_NAME: string
 *
 * Methods:
 *
 * public function getState(): bool;
 * public function switchState(): bool;
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array<string, mixed> $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public function read(Storable $storable): Component;
 * public function readAll(string $location, string $container): array;
 * public function write(Component $component): bool;
 * public function delete(Storable $storable): bool;
 * public function getStorageDirectoryPath(): string;
 * public function getStoragePath(Storable $storable): string;
 *
 */
interface JsonStorageDriver extends StorageDriver
{

    /**
     * @var string STORAGE_DIRECTORY_NAME The name of the top level
     *                                    directory used for storage.
     */                                    
    public const STORAGE_DIRECTORY_NAME = 'StoredComponentJsonData';

    /**
     * Return the full path to the top level directory used for 
     * storage.
     *
     * @return string The full path to top level directory used for 
     *                storage.
     */
    public function getStorageDirectoryPath(): string;

    /**
     * Use a Storable to determine the full path to the json file
     * that would be created for a Component if it was stored.
     */
    public function getStoragePath(Storable $storable): string;

}
