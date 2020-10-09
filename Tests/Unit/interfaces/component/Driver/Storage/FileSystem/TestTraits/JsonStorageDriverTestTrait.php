<?php

namespace UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

trait JsonStorageDriverTestTrait
{

    private JsonStorageDriverInterface $jsonStorageDriver;

    protected function getTestInstanceArgs(): array
    {
        return [
            new Storable(
                'MockJsonName',
                'MockJsonLocation',
                'MockJsonContainer'
            ),
            new Switchable()
        ];
    }
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
        $namespacePath = str_replace(
            ['UnitTests', '\\'],
            ['Tests\\Unit', DIRECTORY_SEPARATOR],
            __NAMESPACE__
        );
        return str_replace($namespacePath, '', __DIR__) . '.dcmsJsonData';
    }

    public function testGetStorageDirectoryPathReturnsExpectedStorageDirectoryPath(): void
    {
        $this->assertEquals(
            self::getExpectedStorageDirectoryPath(),
            $this->getJsonStorageDriver()->getStorageDirectoryPath(),
            'getStorageDirectoryPath() did not return the expected storage directory path.'
        );
    }

    public function getJsonStorageDriver(): JsonStorageDriverInterface
    {
        return $this->jsonStorageDriver;
    }

    public function setJsonStorageDriver(JsonStorageDriverInterface $jsonStorageDriver): void
    {
        $this->jsonStorageDriver = $jsonStorageDriver;
    }

    public function testWriteAddsComponentsStorableToStorageIndex(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $storageIndex = json_decode(file_get_contents($this->getExpectedStorageIndexPath()), true);
        $this->assertTrue(
            isset(
                $storageIndex[$this->getJsonStorageDriver()->getLocation()][$this->getJsonStorageDriver()->getContainer()][$this->getJsonStorageDriver()->getUniqueId()]
            ),
            'Component\'s storable was not saved to storage index on write.'
        );
    }

    private function turnJsonOn(): void
    {
        if ($this->getJsonStorageDriver()->getState() === false) {
            $this->getJsonStorageDriver()->switchState();
        }
    }

    private function getExpectedStorageIndexPath(): string
    {
        return self::getExpectedStorageDirectoryPath() . DIRECTORY_SEPARATOR . 'storageIndex.json';
    }

    public function testDeleteRemovesSpecifiedComponent(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->getJsonStorageDriver()->delete($this->getJsonStorageDriver()->export()['storable']);
        $this->assertFalse(
            file_exists($this->getExpectedStoragePath($this->getJsonStorageDriver())),
            'delete() failed to remove the data stored at ' . $this->getExpectedStoragePath($this->getJsonStorageDriver())
        );
    }

    private static function getExpectedStoragePath(StorableInterface $storable): string
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

    public function testDeleteRemovesComponentsStorableFromStorageIndex(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->getJsonStorageDriver()->delete($this->getJsonStorageDriver()->export()['storable']);
        $storageIndex = json_decode(file_get_contents($this->getExpectedStorageIndexPath()), true);
        $this->assertFalse(
            isset(
                $storageIndex[$this->getJsonStorageDriver()->getLocation()][$this->getJsonStorageDriver()->getContainer()][$this->getJsonStorageDriver()->getUniqueId()]
            ),
            'Component\'s storable was not removed from storage index on delete.'
        );
    }

    public function testStorageDirectoryExistsPostInstantiation(): void
    {
        $this->assertTrue(
            is_dir(self::getExpectedStorageDirectoryPath()),
            'Storage directory " ' . self::getExpectedStorageDirectoryPath() . '" does not exist, and was not created on instantiation.'
        );
    }

    public function testStorageIndexExistsPostInstantiation(): void
    {
        $this->assertTrue(
            file_exists($this->getExpectedStorageIndexPath()),
            'Storage index does not exist at ' . self::getExpectedStorageDirectoryPath() . DIRECTORY_SEPARATOR . 'storageIndex.json'
        );
    }

    public function testWriteSavesComponentDataToJsonFileNamedUsingComponentIdUnderSubPathDefinedUsingComponentLocationAndContainer(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->assertTrue(
            file_exists(self::getExpectedStoragePath($this->getJsonStorageDriver())),
            'Write did not create json data file ' . self::getExpectedStoragePath($this->getJsonStorageDriver())
        );
    }

    public function testGetStoragePathReturnsExpectedStoragePath(): void
    {
        $this->assertEquals(
            self::getExpectedStoragePath($this->getJsonStorageDriver()),
            $this->getJsonStorageDriver()->getStoragePath($this->getJsonStorageDriver())
        );
    }

    public function testReadReturnsComponentSpecifiedByStorable(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $storedComponent = $this->getJsonStorageDriver()->read($this->getJsonStorageDriver());
        $this->assertEquals($this->getJsonStorageDriver(), $storedComponent);
    }

    public function testReadAllReturnsArrayOfAllComponentsStoredInSpecifiedContainerAtSpecifiedLocation(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->assertTrue(
            in_array(
                $this->getJsonStorageDriver(),
                $this->getJsonStorageDriver()->readAll(
                    $this->getJsonStorageDriver()->getLocation(),
                    $this->getJsonStorageDriver()->getContainer()
                )
            ),
            'Read all did not return all components stored in ' . $this->getJsonStorageDriver()->getContainer() . ' at ' . $this->getJsonStorageDriver()->getLocation()
        );
    }

    public function testWriteDoesNotWriteAndReturnsFalseIfStateIsFalse(): void
    {
        $this->turnJsonOff();
        $this->assertFalse(
            $this->getJsonStorageDriver()->write($this->getJsonStorageDriver()),
            'write() must return false if state is false.'
        );
        $this->assertNotEquals(
            $this->getJsonStorageDriver()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'write() must not write if state is false.'
        );
    }

    private function turnJsonOff(): void
    {
        if ($this->getJsonStorageDriver()->getState() === true) {
            $this->getJsonStorageDriver()->switchState();
        }
    }

    private function getStoredComponent(): ComponentInterface
    {
        return $this->getJsonStorageDriver()->read($this->getJsonStorageDriver()->export()['storable']);
    }

    public function testReadReturnsMockComponentIfStateIsFalse(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->turnJsonOff();
        $this->assertNotEquals(
            $this->getJsonStorageDriver()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'read() must return a __MOCK__COMPONENT__ if state is false.'
        );
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getName(),
            'read() must return a __MOCK_COMPONENT__ whose name is __MOCK_COMPONENT__ if state is false.'
        );
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getLocation(),
            'read() must return a __MOCK_COMPONENT__ whose location is __MOCK_COMPONENT__ if state is false.'
        );
        $this->assertEquals(
            '__MOCK_COMPONENT__',
            $this->getStoredComponent()->getContainer(),
            'read() must return a __MOCK_COMPONENT__ whose container is __MOCK_COMPONENT__ if state is false.'
        );
    }

    public function testDeleteReturnsFalseAndDoesNotDeleteIfStateIsFalse(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()->write($this->getJsonStorageDriver());
        $this->turnJsonOff();
        $this->assertFalse(
            $this->getJsonStorageDriver()->delete($this->getJsonStorageDriver()->export()['storable'])
        );
        $this->turnJsonOn();
        $this->assertEquals(
            $this->getJsonStorageDriver()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'read() must return a __MOCK__COMPONENT__ if state is false.'
        );
    }

    protected function setJsonParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getJsonStorageDriver());
        $this->setSwitchableComponentParentTestInstances();
    }

}

