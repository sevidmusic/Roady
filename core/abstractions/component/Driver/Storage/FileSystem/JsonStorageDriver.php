<?php

namespace roady\abstractions\component\Driver\Storage\FileSystem;

use roady\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use roady\classes\component\Component as CoreComponent;
use roady\classes\primary\Storable as CoreStorable;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

abstract class JsonStorageDriver extends SwitchableComponentBase implements JsonStorageDriverInterface
{

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable)
    {
        parent::__construct($storable, $switchable);
        $this->mkdir($this->getStorageDirectoryPath());
        if (file_exists($this->getStorageIndexFilePath()) === false) {
            file_put_contents(
                $this->getStorageIndexFilePath(),
                json_encode([]),
                LOCK_SH
            );
        }
    }

    private function mkdir(string $path): void
    {
        $this->pathIsAvailable($path) && mkdir($path, 0750, true);
    }

    private function pathIsAvailable(string $path): bool
    {
        return (is_dir($path) === false && file_exists($path) === false);
    }

    public function getStorageDirectoryPath(): string
    {
        $namespacePath = str_replace(
            ['roady', '\\'],
            ['core', DIRECTORY_SEPARATOR],
            __NAMESPACE__
        );
        return str_replace($namespacePath, '', __DIR__) . '.' . self::STORAGE_DIRECTORY_NAME;
    }

    private function getStorageIndexFilePath(): string
    {
        return $this->getStorageDirectoryPath() . DIRECTORY_SEPARATOR . 'storageIndex.json';
    }

    public function write(ComponentInterface $component): bool
    {
        if ($this->getState() === false) {
            return false;
        }
        $status = array();
        $this->mkdir($this->getStorageRootPath($component));
        array_push(
            $status,
            (file_put_contents(
                $this->getStoragePath($component),
                $this->pack($component),
                LOCK_SH
            )) > 0
        );
        if (!in_array(false, $status)) {
            array_push($status, $this->addToStorageIndex($component));
        }
        return !in_array(false, $status);
    }

    private function getStorageRootPath(StorableInterface $storable): string
    {
        return
            $this->getStorageDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $storable->getLocation() .
            DIRECTORY_SEPARATOR .
            $storable->getContainer() .
            DIRECTORY_SEPARATOR;
    }

    public function getStoragePath(StorableInterface $storable): string
    {
        return
            $this->getStorageRootPath($storable) .
            substr($storable->getUniqueId(), 0, 32) . '.json';
    }

    private function pack(ComponentInterface $component): string
    {
        $data = $component->export();
        $jsonData = json_encode($this->packObjectsInArray($data));
        return (is_string($jsonData) ? $jsonData : '[]');
    }

    /**
     * Recursively base64_encode() all objects in the $array.
     * @param array<mixed> $array
     * @return array<mixed>
     */
    private function packObjectsInArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_object($value) === true) {
                $array[$key] = base64_encode(serialize($value));
            }
            if (is_array($value) === true) {
                $array[$key] = $this->packObjectsInArray($value);
            }
        }
        return $array;

    }

    private function addToStorageIndex(ComponentInterface $component): bool
    {
        $storageIndex = $this->getStorageIndex();
        $storageIndex[$component->getLocation()][$component->getContainer()][$component->getUniqueId()] = base64_encode(serialize($component->export()['storable']));
        return (
            file_put_contents(
                $this->getStorageIndexFilePath(),
                json_encode($storageIndex),
                LOCK_SH
            ) > 0);
    }

    /**
     * @return array<string, array<string, array<string, string>>>
     */
    private function getStorageIndex(): array
    {
        $data = file_get_contents($this->getStorageIndexFilePath());
        $storageIndex = json_decode(
            (is_string($data) ? $data : '[]'),
            true
        );
        return ((is_array($storageIndex) === true) ? $storageIndex : []);
    }

    public function delete(StorableInterface $storable): bool
    {
        if ($this->getState() === false || $this->notStored($storable) === true) {
            return false;
        }
        if (unlink($this->getStoragePath($storable)) === true) {
            $this->removeFromStorageIndex($storable);
        }
        return $this->notStored($storable);
    }

    private function notStored(StorableInterface $storable): bool
    {
        return (file_exists($this->getStoragePath($storable)) === false);
    }

    private function removeFromStorageIndex(StorableInterface $storable): void
    {
        $storageIndex = $this->getStorageIndex();
        unset(
            $storageIndex[$storable->getLocation()][$storable->getContainer()][$storable->getUniqueId()]
        );
        file_put_contents(
            $this->getStorageIndexFilePath(),
            json_encode($storageIndex),
            LOCK_SH
        ) > 0;
    }

    /**
     * @return array<ComponentInterface>
     */
    public function readAll(string $location, string $container): array
    {
        $components = [];
        $storageIndex = $this->getStorageIndex();
        if (isset($storageIndex[$location][$container]) === true && is_array($storageIndex[$location][$container])) {
            foreach ($storageIndex[$location][$container] as $packedStorable) {
                $storable = unserialize(base64_decode($packedStorable));
                array_push($components, $this->read($storable));
            }
        }
        return $components;
    }

    public function read(StorableInterface $storable): ComponentInterface
    {
        if ($this->getState() === false) {
            return $this->getStandardComponent();
        }
        if ($this->notStored($storable)) {
            return $this->getStandardComponent();
        }
        $data = $this->getStoredData($storable);
        if ($this->dataIsCorrupted($data)) {
            return $this->getStandardComponent();
        }
        $clone = $this->getClone($data['type']);
        $clone->import($this->unpack($data));
        /**
         * !IMPORTANT: Clone's storable must match supplied storable. This MUST
         * be the last thing done before returning!!!
         *
         * Note: Since Components are Storables, Component->export()['storable']
         * MUST be used when handling actual Components or the Component passed
         * as the $storable parameter to read  will be assigned in its entirety
         * to the returned Component's storable, which may not break the returned
         * Component, but will corrupt its data.
         *
         * Put simply, if $storable is a Component, we don't want to assign it
         * as the clone's $storable, we just want it's Storable.
         *
         * If $storable is just a Storable, then assign it to the clone as is.
         */
        switch ($this->isAComponent($storable)) {
            case true:
                /**
                 * @var ComponentInterface $storable If isAComponent(), then use export to get actual storable.
                 */
                $clone->import(['storable' => $storable->export()['storable']]);
                break;
            default:
                $clone->import(['storable' => $storable]);
                break;
        }
        return $clone;
    }

    private function getStandardComponent(): ComponentInterface
    {
        return new CoreComponent(
            new CoreStorable(
                'DefaultComponent',
                'DefaultComponent',
                'DefaultComponent'
            )
        );

    }

    /**
     * @param StorableInterface $storable
     * @return array<mixed>
     */
    private function getStoredData(StorableInterface $storable): array
    {
        $storedData = file_get_contents($this->getStoragePath($storable));
        $data = json_decode((is_string($storedData) ? $storedData : '[]'), true);
        return (is_array($data) ? $data : []);
    }

    /**
     * Determine if the $data is corrupted. The data will be determined to be
     * corrupted if either of the following is true:
     *     1. $data['type'] is not set
     *     2. $data['type'] does not implement the ComponentInterface
     * @param array<mixed> $data
     */
    private function dataIsCorrupted(array $data): bool
    {
        if(isset($data['type']) && class_exists($data['type'])) {
            $classImplements = class_implements($data['type']);
            if(is_array($classImplements) && in_array(ComponentInterface::class, $classImplements)) {
                return false;
            }
        }
        return true;
    }

    private function getClone(string $type): ComponentInterface
    {
        $reflectionUtility = $this->export()['reflectionUtility'];
        return $reflectionUtility->getClassInstance(
            $type,
            $reflectionUtility->generateMockClassMethodArguments(
                $type,
                '__construct'
            )
        );
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    private function unpack(array $data): array
    {
        return $this->unPackObjectsInArray($data);
    }

    /**
     * Recursively base64 decode base64 encoded data in the $array.
     * @param array<mixed> $array
     * @return array<mixed>
     */
    private function unPackObjectsInArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value) === true) {
                $array[$key] = $this->unPackObjectsInArray($value);
                continue;
            }

            if (is_string($value) === false) {
                continue;
            }
            $base64DecodedData = base64_decode($value);
            if ((substr($base64DecodedData, 0, 1)) !== 'O') {
                continue;
            }
            $unserializedData = unserialize($base64DecodedData);
            if (is_object($unserializedData) === false) {
                continue;
            }
            $array[$key] = $unserializedData;

        }
        return $array;
    }

    private function isAComponent(StorableInterface $storable): bool
    {
        $classImplements = class_implements($storable);
        return in_array(ComponentInterface::class, (is_array($classImplements) ? $classImplements : []));
    }

}

