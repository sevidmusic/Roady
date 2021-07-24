<?php

namespace UnitTests\interfaces\component\Driver\Storage\TestTraits;

use roady\abstractions\component\Driver\Storage\StorageDriver as StorageDriverBase;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as CoreJsonStorageDriver;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use roady\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonStorageDriverTestTrait;

trait StandardTestTrait
{

    use JsonStorageDriverTestTrait;

    private StorageDriverBase $standardStorageDriver;

    public function setStorageDriver(StorageDriverBase $standardStorageDriver): void
    {
        $this->standardStorageDriver = $standardStorageDriver;
    }

    protected function setStorageDriverParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStorageDriver());
        $this->setSwitchableComponentParentTestInstances();
        if ($this->storageDriverImplements(JsonStorageDriverInterface::class, $this->getStorageDriver())) {
            $this->setJsonStorageDriver($this->getStorageDriver());
        } else {
            /**
             * @devNote: Allow future Storage Drivers to implement the StorageDriverInterface and still pass
             *           the StorageDriverTestTrait's tests by mocking JsonStorageDriver if StorageDriver
             *           implementation being tested is not compatible with JsonStorageDriverTestTrait
             */
            $this->setJsonStorageDriver(
                new CoreJsonStorageDriver(
                    new CoreStorable(
                        'DEFAULT_JSON_STORAGE_DRIVER',
                        $this->getStorageDriver()->getLocation(),
                        $this->getStorageDriver()->getContainer()
                    ),
                    new CoreSwitchable()
                )
            );
        }
        $this->setJsonParentTestInstances();
    }

    public function getStorageDriver(): StorageDriverBase
    {
        return $this->standardStorageDriver;
    }

    private function storageDriverImplements(string $interface, StorageDriverInterface $storageDriver): bool
    {
        $classImplements = class_implements($storageDriver);
        return in_array($interface, (is_array($classImplements) ? $classImplements : []));
    }

}
