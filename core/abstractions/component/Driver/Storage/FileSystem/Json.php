<?php

namespace DarlingCms\abstractions\component\Driver\Storage\FileSystem;

use DarlingCms\abstractions\component\SwitchableComponent;
use DarlingCms\classes\component\Component as StandardComponent;
use DarlingCms\classes\primary\Storable as StandardStorable;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Driver\Storage\FileSystem\Json as JsonInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class Json extends SwitchableComponent implements JsonInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
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
            ['DarlingCms', '\\'],
            ['core', DIRECTORY_SEPARATOR],
            __NAMESPACE__
        );
        return str_replace($namespacePath, '', __DIR__) . '.dcmsJsonData';
    }

    private function getStorageIndexFilePath(): string
    {
        return $this->getStorageDirectoryPath() . DIRECTORY_SEPARATOR . 'storageIndex.json';
    }

    public function write(Component $component): bool
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

    private function getStorageRootPath(Storable $storable): string
    {
        return
            $this->getStorageDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $storable->getLocation() .
            DIRECTORY_SEPARATOR .
            $storable->getContainer() .
            DIRECTORY_SEPARATOR;
    }

    public function getStoragePath(Storable $storable): string
    {
        return
            $this->getStorageRootPath($storable) .
            substr($storable->getUniqueId(), 0, 32) . '.json';
    }

    private function pack(Component $component): string
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

    private function addToStorageIndex(Component $component): bool
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

    public function delete(Storable $storable): bool
    {
        if ($this->notStored($storable)) {
            return false;
        }
        if (unlink($this->getStoragePath($storable)) === true) {
            $this->removeFromStorageIndex($storable);
        }
        return $this->notStored($storable);
    }

    private function notStored(Storable $storable): bool
    {
        return (file_exists($this->getStoragePath($storable)) === false);
    }

    private function removeFromStorageIndex(Storable $storable): bool
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

    public function read(Storable $storable): Component
    {
        if ($this->notStored($storable)) {
            return $this->getStandardComponent();
        }
        $data = $this->getStoredData($storable);
        if ($this->dataIsCorrupted($data)) {
            return $this->getStandardComponent();
        }
        $clone = $this->getClone($data['type']);
        $clone->import($this->unpack($data));
        return $clone;
    }

    private function getStandardComponent(): Component
    {
        return new StandardComponent(
            new StandardStorable(
                'StandardComponent',
                'StandardComponentLocation',
                'StandardComponentContainer'
            )
        );

    }

    private function getStoredData(Storable $storable)
    {
        return json_decode(file_get_contents($this->getStoragePath($storable)), true);
    }

    private function dataIsCorrupted($data): bool
    {
        return (is_array($data) === false);
    }

    private function getClone(string $type): Component
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

}

