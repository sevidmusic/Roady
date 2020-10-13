<?php

namespace UnitTests\interfaces\component\Driver\Storage\TestTraits;

use DarlingDataManagementSystem\abstractions\component\Driver\Storage\StorageDriver as StorageDriverBase;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as CoreJsonStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonStorageDriverTestTrait;

trait StandardTestTrait
{

    use JsonStorageDriverTestTrait;

    private StorageDriverBase $standardStorageDriver;

    private function storageDriverImplements(string $interface, StorageDriverInterface $storageDriver)
    {
        return in_array($interface, class_implements($storageDriver));
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

    public function setStorageDriver(StorageDriverBase $standardStorageDriver): void
    {
        $this->standardStorageDriver = $standardStorageDriver;
    }

}
