<?php

namespace UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits;

use DarlingCms\interfaces\component\Driver\Storage\FileSystem\Json;
use DarlingCms\interfaces\primary\Storable;

trait JsonTestTrait
{

    private $json;

    public static function tearDownAfterClass(): void
    {
        self::removeDirectory(self::getExpectedStorageDirectoryPath());
    }

    private static function removeDirectory(string $dir): void
    {
        if (is_dir($dir)) {
            $contents = scandir($dir);
            foreach ($contents as $item) {
                if ($item != "." && $item != "..") {
                    $itemPath = $dir . DIRECTORY_SEPARATOR . $item;
                    (is_dir($itemPath) === true && is_link($itemPath) === false)
                        ? self::removeDirectory($itemPath)
                        : unlink($itemPath);
                }
            }
            rmdir($dir);
        }
    }

    private static function getExpectedStorageDirectoryPath(): string
    {
        $namespacePath = str_replace(['UnitTests', '\\'], ['Tests\\Unit', DIRECTORY_SEPARATOR], __NAMESPACE__);
        return str_replace($namespacePath, '', __DIR__) . '.dcmsJsonData';
    }

    public function testGetStorageDirectoryPathReturnsExpectedStorageDirectoryPath(): void
    {
        $this->assertEquals(self::getExpectedStorageDirectoryPath(), $this->getJson()->getStorageDirectoryPath(), 'getStorageDirectoryPath() did not return the expected storage directory path.');
    }

    public function getJson(): Json
    {
        return $this->json;
    }

    public function setJson(Json $json): void
    {
        $this->json = $json;
    }

    public function testStorageDirectoryExistsPostInstantiation(): void
    {
        $this->assertTrue(is_dir(self::getExpectedStorageDirectoryPath()), 'Storage directory " ' . self::getExpectedStorageDirectoryPath() . '" does not exist, and was not created on instantiation.');
    }

    public function testWriteSavesComponentDataToJsonFileNamedUsingComponentIdUnderSubPathDefinedUsingComponentLocationAndContainer(): void
    {
        $this->getJson()->write($this->getJson());
        $this->assertTrue(
            file_exists(self::getExpectedStoragePath($this->getJson())),
            'Write did not create json data file ' . self::getExpectedStoragePath($this->getJson())
        );
    }

    private static function getExpectedStoragePath(Storable $storable): string
    {
        return
            self::getExpectedStorageDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $storable->getLocation() .
            DIRECTORY_SEPARATOR .
            $storable->getContainer() .
            DIRECTORY_SEPARATOR .
            substr($storable->getUniqueId(), 0, 32) . '.json';
    }

    public function testGetStoragePathReturnsExpectedStoragePath(): void
    {
        $this->assertEquals(
            self::getExpectedStoragePath($this->getJson()),
            $this->getJson()->getStoragePath($this->getJson())
        );
    }

    public function testReadReturnsComponentSpecifiedByStorable(): void
    {
        $this->getJson()->write($this->getJson());
        $storable = $this->getJson()->export()['storable'];
        $storedComponent = $this->getJson()->read($storable);
        $storedStorable = $storedComponent->export()['storable'];
        $this->assertEquals($storable, $storedStorable);
    }

    protected function setJsonParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getJson());
        $this->setSwitchableComponentParentTestInstances();
    }
}

