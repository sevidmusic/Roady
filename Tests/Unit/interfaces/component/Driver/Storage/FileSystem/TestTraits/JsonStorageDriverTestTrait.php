<?php

namespace UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits;

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Component;
use roady\interfaces\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\interfaces\primary\Storable as StorableInterface;

trait JsonStorageDriverTestTrait
{

    private JsonStorageDriver $jsonStorageDriver;

    /**
     * @var array<int, Component>
     */
    private array $writtenComponents = [];

    public function testSTORAGE_DIRECTORY_NAMEConstantIsAssignedAnAlphaNumericString(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric(
            $this->getJsonStorageDriver()::STORAGE_DIRECTORY_NAME
        );
    }

    private static function getExpectedStorageDirectoryPath(): string
    {
        $namespacePath = str_replace(
            ['UnitTests', '\\'],
            ['Tests\\Unit', DIRECTORY_SEPARATOR],
            __NAMESPACE__
        );
        return str_replace(
            $namespacePath, '', __DIR__
        ) . '.' . JsonStorageDriver::STORAGE_DIRECTORY_NAME;
    }

    public function testGetStorageDirectoryPathReturnsExpectedStorageDirectoryPath(): void
    {
        $this->assertEquals(
            self::getExpectedStorageDirectoryPath(),
            $this->getJsonStorageDriver()->getStorageDirectoryPath(),
            'getStorageDirectoryPath() did not return the ' .
            'expected storage directory path.'
        );
    }

    public function getJsonStorageDriver(): JsonStorageDriver
    {
        return $this->jsonStorageDriver;
    }

    public function setJsonStorageDriver(
        JsonStorageDriver $jsonStorageDriver
    ): void
    {
        $this->jsonStorageDriver = $jsonStorageDriver;
    }

    private function fileGetContents(string $path): string {
        return strval(file_get_contents($path));
    }

    public function testWriteAddsComponentsStorableToStorageIndex(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()
             ->write($this->getJsonStorageDriver());
        $storageIndex = json_decode(
            $this->fileGetContents(
                $this->getExpectedStorageIndexPath()
            ),
            true
        );
        $this->assertTrue(
            isset(
                $storageIndex
                [$this->getJsonStorageDriver()->getLocation()]
                [$this->getJsonStorageDriver()->getContainer()]
                [$this->getJsonStorageDriver()->getUniqueId()]
            ),
            'Component\'s storable was not saved to storage index ' .
            'on write.'
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
        return self::getExpectedStorageDirectoryPath() .
            DIRECTORY_SEPARATOR . 'storageIndex.json';
    }

    public function testDeleteRemovesSpecifiedComponent(): void
    {
        $this->turnJsonOn();
        $this->writeComponent($this->getJsonStorageDriver());
        $this->getJsonStorageDriver()
             ->delete(
                 $this->getJsonStorageDriver()
                      ->export()['storable']
             );
        $this->assertFalse(
            file_exists(
                $this->getExpectedStoragePath(
                    $this->getJsonStorageDriver()
                )
            ),
            'delete() failed to remove the data stored at ' .
            $this->getExpectedStoragePath(
                $this->getJsonStorageDriver()
            )
        );
    }

    private static function getExpectedStoragePath(
        StorableInterface $storable
    ): string
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
        $this->writeComponent($this->getJsonStorageDriver());
        $this->getJsonStorageDriver()
             ->delete(
                 $this->getJsonStorageDriver()->export()['storable']
             );
        $storageIndex = json_decode(
            $this->fileGetContents(
                $this->getExpectedStorageIndexPath()
            ),
            true
        );
        $this->assertFalse(
            isset(
                $storageIndex
                [$this->getJsonStorageDriver()->getLocation()]
                [$this->getJsonStorageDriver()->getContainer()]
                [$this->getJsonStorageDriver()->getUniqueId()]
            ),
            'Component\'s storable was not removed from storage ' .
            'index on delete.'
        );
    }

    public function testStorageDirectoryExistsPostInstantiation(): void
    {
        $this->assertTrue(
            is_dir(self::getExpectedStorageDirectoryPath()),
            'Storage directory " ' .
            self::getExpectedStorageDirectoryPath() .
            '" does not exist, and was not created on instantiation.'
        );
    }

    public function testStorageIndexExistsPostInstantiation(): void
    {
        $this->assertTrue(
            file_exists($this->getExpectedStorageIndexPath()),
            'Storage index does not exist at ' .
            self::getExpectedStorageDirectoryPath() .
            DIRECTORY_SEPARATOR .
            'storageIndex.json'
        );
    }

    public function testWriteSavesComponentDataToJsonFileNamedUsingComponentIdUnderSubPathDefinedUsingComponentLocationAndContainer(): void
    {
        $this->turnJsonOn();
        $this->getJsonStorageDriver()
             ->write($this->getJsonStorageDriver());
        $this->assertTrue(
            file_exists(
                self::getExpectedStoragePath(
                    $this->getJsonStorageDriver()
                )
            ),
            'Write did not create json data file ' .
            self::getExpectedStoragePath(
                $this->getJsonStorageDriver()
            )
        );
    }

    public function testGetStoragePathReturnsExpectedStoragePath(): void
    {
        $this->assertEquals(
            self::getExpectedStoragePath(
                $this->getJsonStorageDriver()
            ),
            $this->getJsonStorageDriver()
                 ->getStoragePath($this->getJsonStorageDriver())
        );
    }

    public function testReadReturnsComponentSpecifiedByStorable(): void
    {
        $this->turnJsonOn();
        $this->writeComponent($this->getJsonStorageDriver());
        $storedComponent = $this->getJsonStorageDriver()->read(
            $this->getJsonStorageDriver()
        );
        $this->assertEquals(
            $this->getJsonStorageDriver(),
            $storedComponent
        );
    }

    public function testReadAllReturnsArrayOfAllComponentsStoredInSpecifiedContainerAtSpecifiedLocation(): void
    {
        $this->turnJsonOn();
        $this->writeComponent($this->getJsonStorageDriver());
        $this->assertTrue(
            in_array(
                $this->getJsonStorageDriver(),
                $this->getJsonStorageDriver()->readAll(
                    $this->getJsonStorageDriver()->getLocation(),
                    $this->getJsonStorageDriver()->getContainer()
                )
            ),
            'Read all did not return all components stored in ' .
            $this->getJsonStorageDriver()->getContainer() . ' at ' .
            $this->getJsonStorageDriver()->getLocation()
        );
    }

    public function testWriteDoesNotWriteAndReturnsFalseIfStateIsFalse(): void
    {
        $this->turnJsonOff();
        $this->assertFalse(
            $this->getJsonStorageDriver()->write(
                $this->getJsonStorageDriver()
            ),
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

    private function getStoredComponent(): Component
    {
        return $this->getJsonStorageDriver()->read(
            $this->getJsonStorageDriver()->export()['storable']
        );
    }

    public function testReadReturnsMockComponentIfStateIsFalse(): void
    {
        $this->turnJsonOn();
        $this->writeComponent($this->getJsonStorageDriver());
        $this->turnJsonOff();
        $this->assertNotEquals(
            $this->getJsonStorageDriver()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'read() must not return the specified Component if ' .
            'specified Component\'s state is false, and should ' .
            'instead return a new Component instance whose name ' .
            'is "DefaultComponent", location is "DefaultComponent", ' .
            'and container is "DefaultComponent".'
        );
        $this->assertEquals(
            'DefaultComponent',
            $this->getStoredComponent()->getName(),
            'read() must return a Component whose name is ' .
            'DefaultComponent if state is false.'
        );
        $this->assertEquals(
            'DefaultComponent',
            $this->getStoredComponent()->getLocation(),
            'read() must return a Component whose location is ' .
            'DefaultComponent if state is false.'
        );
        $this->assertEquals(
            'DefaultComponent',
            $this->getStoredComponent()->getContainer(),
            'read() must return a Component whose container is ' .
            'DefaultComponent if state is false.'
        );
    }

    public function testDeleteReturnsFalseAndDoesNotDeleteIfStateIsFalse(): void
    {
        $this->turnJsonOn();
        $this->writeComponent($this->getJsonStorageDriver());
        $this->turnJsonOff();
        $this->assertFalse(
            $this->getJsonStorageDriver()->delete(
                $this->getJsonStorageDriver()->export()['storable']
            )
        );
        $this->turnJsonOn();
        $this->assertEquals(
            $this->getJsonStorageDriver()->getUniqueId(),
            $this->getStoredComponent()->getUniqueId(),
            'delete() must return false, and must not delete ' .
            'specified Component if JsonStorageDriver\'s state ' .
            'is false'
        );
    }

    /**
     * @return array<mixed>
     */
    protected function getTestInstanceArgs(): array
    {
        return [
            new Storable(
                'JsonStorageDriverTestTraitMockJsonName',
                'JsonStorageDriverTestTraitMockJsonLocation',
                'JsonStorageDriverTestTraitMockJsonContainer'
            ),
            new Switchable()
        ];
    }

    protected function setJsonParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getJsonStorageDriver());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function tearDown(): void
    {
        foreach($this->writtenComponents as $component) {
            $this->getJsonStorageDriver()->delete($component);
        }
        foreach($this->getJsonStorageDriver()
             ->readAll(
                 $this->getJsonStorageDriver()->getLocation(),
                 $this->getJsonStorageDriver()->getContainer(),
             ) as $component
        ) {
            $this->getJsonStorageDriver()->delete($component);
        }
        $this->getJsonStorageDriver()
             ->delete($this->getJsonStorageDriver());
    }

    private function writeComponent(Component $component): void
    {
        if($this->getJsonStorageDriver()->write($component)) {
            array_push($this->writtenComponents, $component);
        }
    }

}

