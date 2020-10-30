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

    private function getExitingAppName(): string
    {
        return 'DDMSTestApp';
        // once setup tear down implemented:
//        return self::tempAppDirectoryName();
    }

    public static function setUpBeforeClass(): void
    {
        self::createTestAppDirectory();
        self::createTestAppDynamicOutputDirectory();
    }

    public static function tearDownAfterClass(): void
    {
        self::removeTestAppDynamicOutputDirectory();
        self::removeTestAppDirectory();
    }

    private static function createTestAppDynamicOutputDirectory(): void
    {
        if(!is_dir(self::getTestAppDynamicOutputDirectoryPath()))
        {
            # THIS MUST BE FIRST
            mkdir(self::getTestAppDynamicOutputDirectoryPath());
        }
    }

    private static function removeTestAppDynamicOutputDirectory(): void
    {
        if(is_dir(self::getTestAppDynamicOutputDirectoryPath()))
        {
            # THIS MUST BE LAST REMOVAL OR RMDIR WILL FAIL
            rmdir(self::getTestAppDynamicOutputDirectoryPath());
        }
    }

    private static function getTestAppDynamicOutputDirectoryPath(): string
    {
       return self::getTestApDirectoryPath() . 'DynamicOutput';
    }

    private static function createTestAppDirectory(): void
    {
        if(!is_dir(self::getTestApDirectoryPath()))
        {
            # THIS MUST BE FIRST
            mkdir(self::getTestApDirectoryPath());
        }
    }

    private static function removeTestAppDirectory(): void
    {
        if(is_dir(self::getTestApDirectoryPath()))
        {
            # THIS MUST BE LAST REMOVAL OR RMDIR WILL FAIL
            rmdir(self::getTestApDirectoryPath());
        }
    }

    private static function tempAppDirectoryName(): string
    {
        return 'Foo';
    }

    private static function getTestApDirectoryPath(): string
    {
        return self::determineDDMSRootDirectory() . 'Apps' . DIRECTORY_SEPARATOR . self::tempAppDirectoryName() . DIRECTORY_SEPARATOR;
    }

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

    private function defaultAppName(): string
    {
        return $this->getExitingAppName();
    }

    private function defaultDynamicFileName(): string
    {
        return $this->getExistingAppDynamicPhpFileName();
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
            $this->defaultAppName(),
            $this->defaultDynamicFileName()
        ];
    }

    private static function determineCurrentSubDirectoryPath(): string
    {
        return 'Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'TestTraits';
    }

    private function determineAppsSubDirectoryPath(): string
    {
        return 'Apps' . DIRECTORY_SEPARATOR . $this->getDynamicOutputComponent()->export()['appDirectoryName'] . DIRECTORY_SEPARATOR;
    }

    private static function determineDDMSRootDirectory(): string
    {
        return str_replace(
            self::determineCurrentSubDirectoryPath(),
            '',
            __DIR__
        );
    }

    private function expectedCurrentAppDirectoryPath(): string
    {
        return self::determineDDMSRootDirectory() . $this->determineAppsSubDirectoryPath();
    }

    private function getRandomName(): string
    {
        return 'foo' . rand(100000,99999) . 'bar' . rand(100,999) . 'baz' . rand(10000000,99999999);
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

        return self::determineDDMSRootDirectory() . 'SharedDynamicOutput' . DIRECTORY_SEPARATOR;
    }

    private function expectedAppsDynamicOutputFileDirectoryPath(): string
    {
        return $this->expectedCurrentAppDirectoryPath() . 'DynamicOutput' . DIRECTORY_SEPARATOR;
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

    public function testGetAppsDynamicOutputFilesDirectoryPathThrowsRuntimeExceptionIfAppsDynamicOutputDirectoryDoesNotExist(): void
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

    private function getDuplicateDynamicTxtFileName(): string
    {
        return 'Duplicate.txt';
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
        $this->getDynamicOutputComponent()->import(['dynamicFileName' => $this->getRandomName()]);
        $this->getDynamicOutputComponent()->getDynamicFilePath();
    }


    private function executePhpFileInOutputBuffer(string $pathToFile): string
    {
        ob_start();
        require $pathToFile;
        return ob_get_clean();
    }

    private function getFileContentsAsPlainText(string $pathToFile): string
    {
        return file_get_contents($pathToFile);
    }

    public function testGetOutputReturnsStringConstructedByGettingContentsOfDynamicOutputFileAsPlainTextIfDynamicOutputFileDoesNotHaveThePhpExtension(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExitingAppName(),
            $this->getDuplicateDynamicTxtFileName()
        );
        $this->assertEquals(
            $this->getFileContentsAsPlainText(
                $doc->getDynamicFilePath()
            ),
            $doc->getOutput()
        );
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

    public function testAppDirectoryNamePropertyMatchesSpecifiedAppDirectoryName(): void
    {
        $this->assertEquals(
            $this->defaultAppName(),
            $this->getDynamicOutputComponent()->export()['appDirectoryName']
        );
    }

    public function testDynamicFileNamePropertyMatchesSpecifiedDynamicFileName(): void
    {
        $this->assertEquals(
            $this->defaultDynamicFileName(),
            $this->getDynamicOutputComponent()->export()['dynamicFileName']
        );
    }

}
