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

    private DynamicOutputComponentInterface $dynamicOutputComponent;

    private function getExistingAppName(): string
    {
        return self::tempAppDirectoryName();
    }

    public static function setUpBeforeClass(): void
    {
        self::createTestAppDirectory();
        self::createTestAppDynamicOutputDirectory();
        self::createDuplicateDynamicOutputFiles();
        self::createUniqueSharedDynamicOutputFile();
    }

    public static function tearDownAfterClass(): void
    {
        self::removeUniqueSharedDynamicOutputFile();
        self::removeDuplicateDynamicOutputFiles();
        self::removeTestAppDynamicOutputDirectory();
        self::removeTestAppDirectory();
    }

    private static function getAppsDuplicateTxtFilePath(): string
    {
        return self::getTestAppDynamicOutputDirectoryPath() . self::getDuplicateDynamicTxtFileName();
    }

    private static function getAppsDuplicatePhpFilePath(): string
    {
        return self::getTestAppDynamicOutputDirectoryPath() . self::getDuplicateDynamicPhpFileName();
    }

    private static function getSharedDuplicateTxtFilePath(): string
    {
        return self::expectedSharedDynamicOutputFileDirectoryPath() . self::getDuplicateDynamicTxtFileName();
    }

    private static function getSharedDuplicatePhpFilePath(): string
    {
        return self::expectedSharedDynamicOutputFileDirectoryPath() . self::getDuplicateDynamicPhpFileName();
    }


    private static function getUniqueSharedPhpFilePath(): string
    {
        return self::expectedSharedDynamicOutputFileDirectoryPath() . self::getUniqueSharedDynamicPhpFileName();
    }

    private static function createUniqueSharedDynamicOutputFile(): void
    {
        $php = '<?php echo "Hello world";';
        if(!file_exists(self::getUniqueSharedPhpFilePath()))
        {
            file_put_contents(self::getUniqueSharedPhpFilePath(), $php);
        }
    }

    private static function removeUniqueSharedDynamicOutputFile(): void
    {
        if(file_exists(self::getUniqueSharedPhpFilePath()))
        {
            unlink(self::getUniqueSharedPhpFilePath());
        }
    }






    private static function createAppsDuplicateDynamicOutputFiles(): void
    {
        $plainText = 'plain text';
        $php = '<?php echo "Hello world";';
        if(!file_exists(self::getAppsDuplicateTxtFilePath()))
        {
            file_put_contents(self::getAppsDuplicateTxtFilePath(), $plainText);
        }
        if(!file_exists(self::getAppsDuplicatePhpFilePath()))
        {
            file_put_contents(self::getAppsDuplicatePhpFilePath(), $php);
        }
    }

    private static function removeAppsDuplicateDynamicOutputFiles(): void
    {
        if(file_exists(self::getAppsDuplicateTxtFilePath()))
        {
            unlink(self::getAppsDuplicateTxtFilePath());
        }
        if(file_exists(self::getAppsDuplicatePhpFilePath()))
        {
            unlink(self::getAppsDuplicatePhpFilePath());
        }
    }

    private static function createSharedDuplicateDynamicOutputFiles(): void
    {
        $plainText = 'plain text';
        $php = '<?php echo "Hello world";';
        if(!file_exists(self::getSharedDuplicateTxtFilePath()))
        {
            file_put_contents(self::getSharedDuplicateTxtFilePath(), $plainText);
        }
        if(!file_exists(self::getSharedDuplicatePhpFilePath()))
        {
            file_put_contents(self::getSharedDuplicatePhpFilePath(), $php);
        }
    }

    private static function removeSharedDuplicateDynamicOutputFiles(): void
    {
        if(file_exists(self::getSharedDuplicateTxtFilePath()))
        {
            unlink(self::getSharedDuplicateTxtFilePath());
        }
        if(file_exists(self::getSharedDuplicatePhpFilePath()))
        {
            unlink(self::getSharedDuplicatePhpFilePath());
        }
    }

    private static function createDuplicateDynamicOutputFiles(): void
    {
        self::createAppsDuplicateDynamicOutputFiles();
        self::createSharedDuplicateDynamicOutputFiles();
    }

    private static function removeDuplicateDynamicOutputFiles(): void
    {
        self::removeAppsDuplicateDynamicOutputFiles();
        self::removeSharedDuplicateDynamicOutputFiles();
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
       return self::getTestApDirectoryPath() . 'DynamicOutput' . DIRECTORY_SEPARATOR;
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

    public static function tempAppDirectoryName(): string
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
        return $this->getExistingAppName();
    }

    private function defaultDynamicFileName(): string
    {
        return self::getExistingAppDynamicPhpFileName();
    }

    /**
     * @return array{0: CoreStorable, 1: CoreSwitchable, 2: CorePositionable, 3: string}
     */
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

    private static function getRandomName(): string
    {
        return 'foo' . rand(100000,99999) . 'bar' . rand(100,999) . 'baz' . rand(10000000,99999999);
    }

    private static function getExistingAppDynamicPhpFileName(): string
    {
        return self::getDuplicateDynamicPhpFileName();
    }

/*    private static function getExistingSharedDynamicPhpFileName(): string
    {
        return 'CurrentRequestDisplay.php';
    }
*/
    private static function expectedSharedDynamicOutputFileDirectoryPath(): string
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
        $this->getDynamicOutputComponent()->import(['appDirectoryName' => self::getRandomName()]);
        if(!is_dir($this->expectedAppsDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
            $this->getDynamicOutputComponent()->getAppsDynamicOutputFilesDirectoryPath();
        }
        $this->assertTrue(true);
    }

    public function testGetSharedDynamicOutputFilesDirectoryPathReturnsExpectedPath(): void
    {
        if(!is_dir(self::expectedSharedDynamicOutputFileDirectoryPath()))
        {
            $this->expectException(RuntimeException::class);
        }
        $this->assertEquals(
            self::expectedSharedDynamicOutputFileDirectoryPath(),
            $this->getDynamicOutputComponent()->getSharedDynamicOutputFilesDirectoryPath()
        );
    }

    public function testGetSharedDynamicOutputFilesDirectoryPathThrowsRuntimeExceptionIfSharedDynamicOutputDirectoryDoesNotExist(): void
    {
        if(!is_dir(self::expectedSharedDynamicOutputFileDirectoryPath()))
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

    private static function getDuplicateDynamicTxtFileName(): string
    {
        return 'Duplicate.txt';
    }

    private static function getDuplicateDynamicPhpFileName(): string
    {
        return 'Duplicate.php';
    }

    private static function getUniqueSharedDynamicPhpFileName(): string
    {
        return 'UniqueSharedOutput.php';
    }

    public function testGetDynamicFilePathReturnsAppDynamicFilePathIfDynamicFileExistsInBothAppDynamicOutputDirectoryAndSharedDynamicOutputDirectory(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExistingAppName(),
            self::getDuplicateDynamicPhpFileName()
        );
        $this->assertEquals(
            $this->expectedAppsDynamicOutputFileDirectoryPath() . self::getDuplicateDynamicPhpFileName(),
            $doc->getDynamicFilePath()
        );
    }

    public function testGetDynamicFilePathReturnsSharedDynamicFilePathIfDynamicFileDoesNotExistInAppDynamicOutputDirectory(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExistingAppName(),
            self::getUniqueSharedDynamicPhpFileName()
        );
        $this->assertEquals(
            self::expectedSharedDynamicOutputFileDirectoryPath() . self::getUniqueSharedDynamicPhpFileName(),
            $doc->getDynamicFilePath()
        );
    }

    public function testGetDynamicFilePathThrowsRuntimeExceptionIfDynamicFileDoesNotExistInEitherAppOrSharedDynamicOutputDirectory(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getDynamicOutputComponent()->import(['dynamicFileName' => self::getRandomName()]);
        $this->getDynamicOutputComponent()->getDynamicFilePath();
    }


    private function executePhpFileInOutputBuffer(string $pathToFile): string
    {
        ob_start();
        require $pathToFile;
        $output = ob_get_clean();
        return (is_string($output) ? $output : '');
    }

    private function getFileContentsAsPlainText(string $pathToFile): string
    {
        $contents = file_get_contents($pathToFile);
        return (is_string($contents) ? $contents : '');
    }

    public function testGetOutputReturnsStringConstructedByGettingContentsOfDynamicOutputFileAsPlainTextIfDynamicOutputFileDoesNotHaveThePhpExtension(): void
    {
        $doc = $this->buildCoreDynamicOutputComponent(
            $this->getExistingAppName(),
            self::getDuplicateDynamicTxtFileName()
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
            $this->getExistingAppName(),
            self::getDuplicateDynamicPhpFileName()
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
