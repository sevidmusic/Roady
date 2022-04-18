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
             * @devNote: roady's core implementation of the
             *           StorageDriver interface is in fact
             *           an extension of roady's core implementation
             *           of the JsonStorageDriver interface.
             *
             *           The StandardTestTrait, which is used to
             *           test roady's core StorageDriver, does
             *           not define any of it's own tests, instead
             *           it uses the JsonStorageDriverTestTrait's
             *           tests.
             *
             *           The following call to setJsonStorageDriver()
             *           is needed to allow future Storage Drivers to
             *           implement the StorageDriverInterface still
             *           pass the StandardTestTrait's tests by mocking
             *           a JsonStorageDriver if the StorageDriver
             *           implementation being tested is not
             *           compatible with the
             *           JsonStorageDriverTestTrait.
             */
            $prefix = 'StandardTestTraitMockJsonStorageDriverUsedForCompatibilityWithJsonStorageDriverTestTrait';
            $this->setJsonStorageDriver(
                new CoreJsonStorageDriver(
                    new CoreStorable(
                        $prefix . 'Name',
                        $prefix . 'Location',
                        $prefix . 'Container'
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
