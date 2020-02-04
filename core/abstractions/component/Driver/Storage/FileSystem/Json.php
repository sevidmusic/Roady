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

    public function write(Component $component): bool
    {
        $this->mkdir($this->getStorageRootPath($component));
        return (
            file_put_contents(
                $this->getStoragePath($component),
                $this->pack($component),
                LOCK_SH
            )
            ) > 0;
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
        foreach ($data as $key => $datum) {
            if (is_object($datum) === true) {
                $data[$key] = base64_encode(serialize($datum));
            }
        }
        return json_encode($data);
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

    private function notStored(Storable $storable): bool
    {
        return (file_exists($this->getStoragePath($storable)) === false);
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
        foreach ($data as $key => $datum) {
            if (is_string($datum) === false) {
                continue;
            }
            $base64DecodedData = base64_decode($datum);
            if ((substr($base64DecodedData, 0, 1)) !== 'O') {
                continue;
            }
            $unserializedData = unserialize($base64DecodedData);
            if (is_object($unserializedData) === false) {
                continue;
            }
            $data[$key] = $unserializedData;
        }
        return $data;
    }
}
