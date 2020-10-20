<?php

namespace DarlingDataManagementSystem\abstractions\component\Driver\Storage\FileSystem;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\classes\component\Component as CoreComponent;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

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

    private function mkdir(string $path): bool
    {
        return $this->pathIsAvailable($path) ? mkdir($path, 0744, LOCK_SH) : false;
    }

    private function pathIsAvailable(string $path): bool
    {
        return (is_dir($path) === false && file_exists($path) === false);
    }

    public function getStorageDirectoryPath(): string
    {
        $namespacePath = str_replace(
            ['DarlingDataManagementSystem', '\\'],
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
        return json_encode($this->packObjectsInArray($data));
    }

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

    private function getStorageIndex(): array
    {
        $storageIndex = json_decode(
            file_get_contents($this->getStorageIndexFilePath()),
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

    private function removeFromStorageIndex(StorableInterface $storable): bool
    {
        $storageIndex = $this->getStorageIndex();
        unset(
            $storageIndex[$storable->getLocation()][$storable->getContainer()][$storable->getUniqueId()]
        );
        return (
            file_put_contents(
                $this->getStorageIndexFilePath(),
                json_encode($storageIndex),
                LOCK_SH
            ) > 0);
    }

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
            return new CoreComponent(
                new CoreStorable(
                    '__MOCK_COMPONENT__',
                    '__MOCK_COMPONENT__',
                    '__MOCK_COMPONENT__'
                )
            );
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
         * !IMPORTANT: Clone's storable must match supplied storable.
         * This MUST be the last thing done before returning!!!
         * Note, since Components are StorableInterface, export MUST
         * be used when handling actual components or the
         * ComponentInterface passed to read as the StorableInterface will
         * be assigned in it's entirety to the returned
         * ComponentInterface's storable, which may not break the
         * returned ComponentInterface, but will corrupt it's data.
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
                'CoreComponent',
                'StandardComponentLocation',
                'StandardComponentContainer'
            )
        );

    }

    private function getStoredData(StorableInterface $storable)
    {
        return json_decode(file_get_contents($this->getStoragePath($storable)), true);
    }

    private function dataIsCorrupted($data): bool
    {
        return (is_array($data) === false);
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

    private function unpack(array $data): array
    {
        return $this->unPackObjectsInArray($data);
    }

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
        return in_array(ComponentInterface::class, class_implements($storable));
    }

}

