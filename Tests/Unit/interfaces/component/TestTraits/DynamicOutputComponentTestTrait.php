<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent as CoreDynamicOutputComponent;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use RuntimeException;

trait DynamicOutputComponentTestTrait
{

    private $dynamicOutputComponent;

    protected function setDynamicOutputComponentParentTestInstances(): void
    {
        $this->setOutputComponent($this->getDynamicOutputComponent());
        $this->setOutputComponentParentTestInstances();
    }

    public function getDynamicOutputComponent(): DynamicOutputComponentInterface
    {
        return $this->dynamicOutputComponent;
    }

    public function setDynamicOutputComponent(DynamicOutputComponentInterface $dynamicOutputComponent): void
    {
        $this->dynamicOutputComponent = $dynamicOutputComponent;
    }

    public function getDynamicOutputComponentTestArgs(): array
    {
        return [
            new CoreStorable(
                'DynamicOutputComponentName',
                'DynamicOutputComponentLocation',
                'DynamicOutputComponentContainer'
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            $this->getExitingAppName(),
            $this->getExistingAppDynamicPhpFileName()
        ];
    }

    private function expectedCurrentAppDirectoryPath(): string
    {
        return str_replace(
            'Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'TestTraits',
            'Apps' . DIRECTORY_SEPARATOR . $this->getDynamicOutputComponent->export()['appDirectoryName'] . DIRECTORY_SEPARATOR,
            __DIR__
        );
    }

    private function getRandomName(): string
    {
        return 'foo' . rand(100000,99999) . 'bar' . rand(100,999) . 'baz' . rand(10000000,99999999);
    }

    private function getExitingAppName(): string
    {
        return 'helloWorld';
    }


    public function testRuntimeExceptionIsNotThrownOnInstantiationIfDynamicOutputFileNamePropertyMatchesTheNameOfAFileThatExistsInEitherTheAppsOrSharedDynamicOutputFilesDirectory(): void
    {
        $appDoc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getExistingAppDynamicPhpFileName()
        );
        $appDoc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getExistingSharedDynamicPhpFileName()
        );
        $this->assertTrue(true);
    }

    public function testRuntimeExceptionIsThrownOnInstantiationIfDynamicOutputFileNamePropertyDoesNotMatchTheNameOfAFileThatExistsInEitherTheAppsOrSharedDynamicOutputFilesDirectory(): void
    {
        $invalidFileName = $this->getRandomName();
        $this->expectException(RuntimeException::class);
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $invalidFileName
        );
    }

    public function testRuntimeExceptionIsThrownOnInstantiationIfAppDirectoryNamePropertyDoesNotMatchTheNameOfAnExistingAppDirectroy(): void
    {
        $invalidAppName = $this->getRandomName();
        $this->expectException(RuntimeException::class);
        $doc = $this->buildCoreDynamicOutputComponent(
            $invalidAppName,
            $this->getExistingAppDynamicPhpFileName()
        );
    }

    private function getExistingAppDynamicPhpFileName(): string
    {
        return 'DisplayCurrentDateTime.php';
    }

    private function getExistingSharedDynamicPhpFileName(): string
    {
        return 'CurrentRequestDisplay.php';
    }

    private function expectedSharedDynamicOutputFileDirectoryPath(): string
    {
        return str_replace('Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'TestTraits', 'SharedDynamicOutput' . DIRECTORY_SEPARATOR, __DIR__);
    }

    private function expectedAppsDynamicOutputFileDirectoryPath(): string
    {
        return str_replace('Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'TestTraits', 'Apps' . DIRECTORY_SEPARATOR . $this->getDynamicOutputComponent()->export()['appDirectoryName'] . DIRECTORY_SEPARATOR . 'DynamicOutput' . DIRECTORY_SEPARATOR, __DIR__);
    }

    public function testGetAppsDynamicOutputFilesDirectoryPathReturnsExpectedPath(): void
    {
        if(!is_dir($this->expectedAppsDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
        }
        $this->assertEquals(
            $this->expectedAppsDynamicOutputFileDirectoryPath(),
            $this->getDynamicOutputComponent()->getAppsDynamicOutputFilesDirectoryPath()
        );
    }

    public function testGetAppsDynamicFilesDirectoryPathThrowsRuntimeExceptionIfAppsDynamicOutputDirectoryDoesNotExist(): void
    {
        $this->getDynamicOutputComponent()->import(['appDirectoryName' => $this->getRandomName()]);
        if(!is_dir($this->expectedAppsDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
            $this->getDynamicOutputComponent()->getAppsDynamicOutputFilesDirectoryPath();
        }
        $this->assertTrue(true);
    }

    public function testGetSharedDynamicOutputFilesDirectoryPathReturnsExpectedPath(): void
    {
        if(!is_dir($this->expectedSharedDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
        }
        $this->assertEquals(
            $this->expectedSharedDynamicOutputFileDirectoryPath(),
            $this->getDynamicOutputComponent()->getSharedDynamicOutputFilesDirectoryPath()
        );
    }

    public function testGetSharedDynamicOutputFilesDirectoryPathThrowsRuntimeExceptionIfSharedDynamicOutputDirectoryDoesNotExist(): void
    {
        if(!is_dir($this->expectedSharedDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
            $this->getDynamicOutputComponent()->getSharedDynamicOutputFilesDirectoryPath();
        }
        $this->assertTrue(true);
    }

    protected function buildCoreDynamicOutputComponent(string $appName, string $fileName): CoreDynamicOutputComponent
    {
         return new CoreDynamicOutputComponent(
            new CoreStorable(
                'DynamicOutputComponentName',
                'DynamicOutputComponentLocation',
                'DynamicOutputComponentContainer'
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            $appName,
            $fileName
        );
    }

    private function getDuplicateDynamicPhpFileName(): string
    {
        return 'Duplicate.php';
    }

    private function getUniqueSharedDynamicPhpFileName(): string
    {
        return 'UniqueSharedOutput.php';
    }

    public function testGetDynamicFilePathReturnsAppDynamicFilePathIfDynamicFileExistsInAppDynamicDirectory(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getDuplicateDynamicPhpFileName()
        );
        $this->assertEquals(
            $this->expectedAppsDynamicOutputFileDirectoryPath() . $this->getDuplicateDynamicPhpFileName(),
            $doc->getDynamicFilePath()
        );
    }

    public function testGetDynamicFilePathReturnsSharedDynamicFilePathIfDynamicFileDoesNotExistInAppDynamicDirectory(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getUniqueSharedDynamicPhpFileName()
        );
        $this->assertEquals(
            $this->expectedSharedDynamicOutputFileDirectoryPath() . $this->getUniqueSharedDynamicPhpFileName(),
            $doc->getDynamicFilePath()
        );
    }

    public function testGetDynamicFilePathThrowsRuntimeExceptionIfDynamicFileDoesNotExistInEitherAppOrSharedDynamicOutputDirectory(): void
    {
        $this->expectException(RuntimeException::class);
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getRandomName()
        );
    }


    private function executePhpFileInOutputBuffer(string $pathToFile): string
    {
        ob_start();
        require $pathToFile;
        return ob_get_clean();
    }

    public function testGetOutputReturnsStringConstructedByExecutingDynamicOutputFileIfDynamicOutputFileIsAPhpFile(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getDuplicateDynamicPhpFileName()
        );
        $this->assertEquals(
            $this->executePhpFileInOutputBuffer(
                $doc->getDynamicFilePath()
            ),
            $doc->getOutput()
        );
    }

}
