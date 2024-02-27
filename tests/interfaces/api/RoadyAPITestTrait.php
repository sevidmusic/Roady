<?php

namespace Darling\Roady\tests\interfaces\api;

use Darling\PHPFileSystemPaths\interfaces\paths\PathToExistingDirectory;
use Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory as PathToExistingDirectoryInstance;
use Darling\PHPTextTypes\interfaces\collections\SafeTextCollection;
use Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use Darling\PHPTextTypes\interfaces\strings\SafeText;
use Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use Darling\PHPTextTypes\interfaces\strings\Text;
use Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules as PathToDirectoryOfRoadyModulesInstance;
use \Darling\Roady\interfaces\api\RoadyAPI;
use \PHPUnit\Framework\Attributes\CoversClass;

/**
 * The RoadyAPITestTrait defines common tests for implementations of
 * the RoadyAPI interface.
 *
 * @see RoadyAPI
 *
 */
#[CoversClass(RoadyAPI::class)]
trait RoadyAPITestTrait
{

    private PathToDirectoryOfRoadyModules $expectedPathToDirectoryOfRoadyModules;

    /**
     * @var RoadyAPI $roadyAPI An instance of a RoadyAPI
     *                         implementation to test.
     */
    protected RoadyAPI $roadyAPI;

    /**
     * Set up an instance of a RoadyAPI implementation to test.
     *
     * This method must set the RoadyAPI implementation instance
     * to be tested via the setRoadyAPITestInstance() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $this->setRoadyAPITestInstance(
     *         new \Darling\Roady\classes\api\RoadyAPI()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the RoadyAPI implementation instance to test.
     *
     * @return RoadyAPI
     *
     */
    protected function roadyAPITestInstance(): RoadyAPI
    {
        return $this->roadyAPI;
    }

    /**
     * Set the RoadyAPI implementation instance to test.
     *
     * @param RoadyAPI $roadyAPITestInstance
     *                              An instance of an
     *                              implementation of
     *                              the RoadyAPI
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setRoadyAPITestInstance(
        RoadyAPI $roadyAPITestInstance
    ): void
    {
        $this->roadyAPI = $roadyAPITestInstance;
    }

    /**
     * Return the PathToDirectoryOfRoadyModules instance that is
     * expected to be returned by the RoadyAPI instance being
     * tested's pathToDirectoryOfRoadyModules() method.
     *
     * @reurn PathToDirectoryOfRoadyModules
     *
     */
    public function expectedPathToDirectoryOfRoadyModules(): PathToDirectoryOfRoadyModules
    {
        $roadysRootDirectory = str_replace('tests' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'api', '', __DIR__);
        $roadysRootDirectoryParts = explode(
            DIRECTORY_SEPARATOR,
            $roadysRootDirectory
        );
        $safeText = [];
        foreach ($roadysRootDirectoryParts as $pathPart) {
            if(!empty($pathPart)) {
                $safeText[] = new SafeTextInstance(
                    new TextInstance($pathPart)
                );
            }
        }
        $safeText[] = new SafeTextInstance(
            new TextInstance('modules')
        );
        return new PathToDirectoryOfRoadyModulesInstance(
            new PathToExistingDirectoryInstance(
                new SafeTextCollectionInstance(...$safeText),
            ),
        );
    }

    public function test_pathToDirectoryOfRoadyModules_returns_the_expected_PathToDirectoryOfRoadyModules_instance(): void
    {
        $this->assertEquals(
            $this->expectedPathToDirectoryOfRoadyModules(),
            $this->roadyAPITestInstance()::pathToDirectoryOfRoadyModules(),
            $this->testFailedMessage(
                $this->roadyAPITestInstance(),
                'pathToDirectoryOfRoadyModules',
                'must return the expected PathToDirectoryOfRoadyModules instance',
            )
        );
    }

    abstract public static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $testedInstance, string $testedMethod, string $expectation): string;

}

