<?php

namespace UnitTests\interfaces\utility\TestTraits;

use Exception;
use roady\interfaces\utility\AppBuilder as AppBuilderInterface;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\classes\utility\AppBuilder;
use roady\classes\component\OutputComponent;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Response;

/**
 * The AppBuilderTestTrait defines tests for implementations of the
 * roady\interfaces\utility\AppBuilder interface.
 *
 * Test Methods:
 *
 * public function testBuildAppIncreasesNumberOfStoredComponentsIfAppDefinesComponents(): void
 * public function testBuildAppStoresAppsConfiguredOutputComponents(): void
 * public function testBuildAppStoresAppsConfiguredRequests(): void
 * public function testBuildAppStoresAppsConfiguredResponses(): void
 * public function testBuildAppUpdatesAppsStoredAppComponentsFactory(): void
 * public function testCallingBuildAppTwiceOnSameAppWithNoChangeToNumberOfConfiguredComponentsResultsInEqualNumberOfStoredComponents(): void
 * public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedAppsNameMatchesTheSpecifiedAppName(): void
 * public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedDomiansUrlMatchesTheSpecifiedDomain(): void
 * public function testGetAppsAppComponentsFactoryReturnsAppComponentsFactoryThatMatchesAppsStoredAppComponentsFactoryInstance(): void
 *
 * Methods:
 *
 * private function createTestApp(
 *     string $appName,
 *     string $domain
 * ): void
 *
 * private function createTestGlobalResponse(
 *     string $appName,
 *     string $domain
 * ): void
 *
 * private function createTestOutputComponent(
 *     string $appName,
 *     string $domain
 * ): void
 *
 * private function createTestRequest(
 *     string $appName,
 *     string $domain
 * ): void
 *
 * private function createTestResponse(
 *     string $appName,
 *     string $domain
 * ): void
 *
 * private function determinAppsLocation(
 *     AppComponentsFactoryInterface $appComponentsFactory
 * ): string
 *
 * private function determinePathToDdmsExecutable(): string
 *
 * private function determinePathToTestApp(string $appName): string
 *
 * private function getRandomDomain(): string
 *
 * private function getRandomName(string $type): string
 *
 * private function registerExpectedGlobalResponse(
 *     string $name,
 *     int|float $position
 * ): void
 *
 * private function registerExpectedOutputComponent(
 *     string $name,
 *     string $output
 * ): void
 *
 * private function registerExpectedRequest(
 *     string $name,
 *     string $relativeUrl
 * ): void
 *
 * private function registerExpectedResponse(
 *     string $name,
 *     int|float $position
 * ): void
 *
 * private function removeTestApp(
 *     AppComponentsFactoryInterface $appComponentsFactory
 * ): void
 *
 * private function verifyExpectedOutputComponentsExist(
 *     AppComponentsFactoryInterface $appComponentsFactory
 * ): void
 *
 * private function verifyExpectedRequestsExist(
 *     AppComponentsFactoryInterface $appComponentsFactory
 * ): void
 *
 * private function verifyExpectedResponsesExist(
 *     AppComponentsFactoryInterface $appComponentsFactory
 * ): void
 *
 * private static function removeAppDirectory(
 *     string $pathToTheAppsDirectory
 * ): void
 *
 */
trait AppBuilderTestTrait
{

    /**
     * @var array<string, string> $expectedOutputComponentNamesAndOutput
     */
    private array $expectedOutputComponentNamesAndOutput = [];

    /**
     * @var array<string, string> $expectedRequestNamesAndUrls
     */
    private array $expectedRequestNamesAndUrls = [];

    /**
     * @var array<string, int|float> $expectedResponseNamesAndPositions
     */

    private array $expectedResponseNamesAndPositions = [];

    /**
     * @var array<string, int|float> $expectedGlobalResponseNamesAndPositions
     */
    private array $expectedGlobalResponseNamesAndPositions = [];

    private string $outputComponentContainer = 'TestOutput';

    /**
     * @devnote: Response container is Response::RESPONSE_CONTAINER
     */
    private string $requestContainer = 'TestRequests';


    private function getRandomName(string $type): string
    {
        return 'Test' . $type . strval(rand(0, PHP_INT_MAX));
    }

    private function getRandomDomain(): string
    {
        return 'http://localhost:' . strval(rand(8000,8999));
    }

    public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedAppsNameMatchesTheSpecifiedAppName(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->assertEquals(
            $appName,
            $appComponentsFactory->getApp()->getName(),
            'The name of the App assigned to the AppComponentsFactory MUST match the name supplied to the $appName parameter.'
        );
        $this->removeTestApp($appComponentsFactory);
    }

    public function testGetAppsAppComponentsFactoryReturnsAnAppComponentsFactoryInstanceWhoseAssignedDomiansUrlMatchesTheSpecifiedDomain(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->assertEquals(
            $domain,
            $appComponentsFactory->getApp()->getAppDomain()->getUrl(),
            'The url assigned to the AppComponentsFactory\'s App\'s assigned domain MUST matc the url passed to the $domain parameter.'
        );
        $this->removeTestApp($appComponentsFactory);
    }

    public function testGetAppsAppComponentsFactoryReturnsAppComponentsFactoryThatMatchesAppsStoredAppComponentsFactoryInstance(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactoryFirstInstance = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $appComponentsFactoryStoredInstance = $appComponentsFactoryFirstInstance->getComponentCrud()->read($appComponentsFactoryFirstInstance);
        $appComponentsFactorySecondInstance = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        /** Test stored instance matches first instance! **/
        $this->assertEquals(
            $appComponentsFactoryFirstInstance,
            $appComponentsFactoryStoredInstance,
            'getAppsAppComponentsFactory() MUST return a AppComponentsFactory that matches the App\'s stored AppComponentsFactory. If the App\'s stored AppComponentsFactory does not exist, getAppsAppComponentsFactory() MUST create it.'
        );
        /** Test second instance matches first instance! **/
        $this->assertEquals(
            $appComponentsFactoryFirstInstance,
            $appComponentsFactorySecondInstance,
            'getAppsAppComponentsFactory() MUST return a AppComponentsFactory that matches the App\'s stored AppComponentsFactory. If the App\'s stored AppComponentsFactory does not exist, getAppsAppComponentsFactory() MUST create it.'
        );
        /** Test second instance matches stored instance! **/
        $this->assertEquals(
            $appComponentsFactoryStoredInstance,
            $appComponentsFactorySecondInstance,
            'getAppsAppComponentsFactory() MUST return a AppComponentsFactory that matches the App\'s stored AppComponentsFactory. If the App\'s stored AppComponentsFactory does not exist, getAppsAppComponentsFactory() MUST create it.'
        );
        /** @var AppComponentsFactoryInterface $appComponentsFactoryFirstInstance */
        $this->removeTestApp($appComponentsFactoryFirstInstance);
        /** @var AppComponentsFactoryInterface $appComponentsFactoryStoredInstance */
        $this->removeTestApp($appComponentsFactoryStoredInstance);
        /** @var AppComponentsFactoryInterface $appComponentsFactorySecondInstance */
        $this->removeTestApp($appComponentsFactorySecondInstance);
    }

    public function testBuildAppIncreasesNumberOfStoredComponentsIfAppDefinesComponents(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestRequest($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        $preBuildStoredComponentCount = count($appComponentsFactory->getStoredComponentRegistry()->getRegistry());
        AppBuilder::buildApp($appComponentsFactory);
        $postBuildStoredComponentCount = count($appComponentsFactory->getStoredComponentRegistry()->getRegistry());
        $this->assertTrue(
            $preBuildStoredComponentCount < $postBuildStoredComponentCount,
            'AppBuilder::buildApp() did not store any Components even though Components were defined by the ' . $appName . ' App.'
        );
        $this->removeTestApp($appComponentsFactory);
    }

    public function testBuildAppUpdatesAppsStoredAppComponentsFactory(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        AppBuilder::buildApp($appComponentsFactory);
        $this->assertEquals(
            $appComponentsFactory,
            AppBuilder::getAppsAppComponentsFactory($appName, $domain),
            'AppBuilder::buildApp() MUST update the App\'s AppComponentsFactory in storage to reflect any changes made to the App\'s AppComponentsFactory on call to AppBuilder::buildApp().'
        );
        $this->removeTestApp($appComponentsFactory);
    }

    public function testCallingBuildAppTwiceOnSameAppWithNoChangeToNumberOfConfiguredComponentsResultsInEqualNumberOfStoredComponents(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestRequest($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        AppBuilder::buildApp($appComponentsFactory);
        $firstBuildCount = count($appComponentsFactory->getStoredComponentRegistry()->getRegistry());
        AppBuilder::buildApp($appComponentsFactory);
        $secondBuildCount = count($appComponentsFactory->getStoredComponentRegistry()->getRegistry());
        $this->assertEquals(
            $firstBuildCount,
            $secondBuildCount,
            'Calling buildApp() twice on App ' . $appName . ' should result in equal number of stored Components since the ' . $appName . ' App still defines the same number of configured Components.'
        );
        $this->removeTestApp($appComponentsFactory);
    }

    public function testBuildAppStoresAppsConfiguredOutputComponents(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        $this->createTestOutputComponent($appName, $domain);
        AppBuilder::buildApp($appComponentsFactory);
        $this->verifyExpectedOutputComponentsExist($appComponentsFactory);
        $this->removeTestApp($appComponentsFactory);
    }

    private function verifyExpectedOutputComponentsExist(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        $appName = $appComponentsFactory->getApp()->getName();
        $appLocation = $this->determinAppsLocation($appComponentsFactory);
        foreach($this->expectedOutputComponentNamesAndOutput as $name => $output) {
            try {
                /**
                 * @var OutputComponentInterface $outputComponent
                 */
                $outputComponent = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                    $name,
                    OutputComponent::class,
                    $appLocation,
                    $this->outputComponentContainer
                );
                $this->assertEquals($output, $outputComponent->getOutput());
            } catch (Exception $e) {
                $this->assertTrue(
                    false,
                    'An OutputComponent named ' . $name . ' was defined by the ' .
                    $appName . ' App but was not stored in the ' . $this->outputComponentContainer .
                    ' container at the expected location, ' . $appLocation .
                    ', on call to AppBuilder::buildApp(...)'
                );
            }
        }
        $this->removeTestApp($appComponentsFactory);
    }

    public function testBuildAppStoresAppsConfiguredResponses(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        $this->createTestGlobalResponse($appName, $domain);
        AppBuilder::buildApp($appComponentsFactory);
        $this->verifyExpectedResponsesExist($appComponentsFactory);
        $this->removeTestApp($appComponentsFactory);
    }

    private function verifyExpectedResponsesExist(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        $appName = $appComponentsFactory->getApp()->getName();
        $appLocation = $this->determinAppsLocation($appComponentsFactory);
        foreach($this->expectedResponseNamesAndPositions as $name => $position) {
            try {
                /**
                 * @var ResponseInterface $response
                 */
                $response = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                    $name,
                    Response::class,
                    $appLocation,
                    ResponseInterface::RESPONSE_CONTAINER
                );
                $this->assertEquals(
                    $position,
                    $response->getPosition()
                );
            } catch (Exception $e) {
                $this->assertTrue(
                    false,
                    'A Response named ' . $name . ' was defined by the ' .
                    $appName . ' App but was not stored in the ' . ResponseInterface::RESPONSE_CONTAINER .
                    ' container at the expected location, ' . $appLocation .
                    ', on call to AppBuilder::buildApp(...)'
                );
            }
        }
    }

    public function testBuildAppStoresAppsConfiguredRequests(): void
    {
        $appName = $this->getRandomName('App');
        $domain = $this->getRandomDomain();
        $appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $domain);
        $this->createTestApp($appName, $domain);
        $this->createTestRequest($appName, $domain);
        $this->createTestRequest($appName, $domain);
        $this->createTestRequest($appName, $domain);
        AppBuilder::buildApp($appComponentsFactory);
        $this->verifyExpectedRequestsExist($appComponentsFactory);
        $this->removeTestApp($appComponentsFactory);
    }

    private function verifyExpectedRequestsExist(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        $appName = $appComponentsFactory->getApp()->getName();
        $appLocation = $this->determinAppsLocation($appComponentsFactory);
        foreach($this->expectedRequestNamesAndUrls as $name => $relativeUrl) {
            try {
                /**
                 * @var RequestInterface $request
                 */
                $request = $appComponentsFactory->getComponentCrud()->readByNameAndType(
                    $name,
                    Request::class,
                    $appLocation,
                    $this->requestContainer
                );
                $this->assertEquals(
                    $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/' . $relativeUrl,
                    $request->getUrl()
                );
            } catch (Exception $e) {
                $this->assertTrue(
                    false,
                    'A Request named ' . $name . ' was defined by the ' .
                    $appName . ' App but was not stored in the ' . $this->requestContainer .
                    ' container at the expected location, ' . $appLocation .
                    ', on call to AppBuilder::buildApp(...)'
                );
            }
        }
        $this->removeTestApp($appComponentsFactory);
    }

    private function determinAppsLocation(AppComponentsFactoryInterface $appComponentsFactory): string
    {
        return $appComponentsFactory->getApp()->deriveAppLocationFromRequest(
            $appComponentsFactory->getApp()->getAppDomain()
        );
    }

    /**
     * Remove any Components created by the App that owns
     * the specified AppComponentsFactory.
     *
     * Also, remove the App directory of the App that owns the
     * specified AppComponentsFactory from roady's Apps directory.
     *
     * @param AppComponentsFactoryInterface $appComponentsFactory
     *                                      The AppComponentsFactory
     *                                      that belongs to the App
     *                                      whose Components should
     *                                      be removed from storage,
     *                                      and whose directory
     *                                      should be removed from
     *                                      roady's Apps directory.
     * @return void
     *
     */
    private function removeTestApp(AppComponentsFactoryInterface $appComponentsFactory): void
    {
        $appName = $appComponentsFactory->getApp()->getName();
        foreach($appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents() as $component) {
            $appComponentsFactory->getComponentCrud()->delete($component);
        }
        $appComponentsFactory->getComponentCrud()->delete($appComponentsFactory);
        $pathToTestApp = $this->determinePathToTestApp($appName);
        self::removeAppDirectory($pathToTestApp);
    }

    /**
     * Determine the path to the specified App in roady's Apps
     * directory.
     *
     * @param string $appName The name of the App.
     *
     * @return string The path to the specified App in roady's Apps
     *                directory.
     */
    private function determinePathToTestApp(string $appName): string
    {
        return str_replace(
            'Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'utility' . DIRECTORY_SEPARATOR . 'TestTraits',
            'Apps' . DIRECTORY_SEPARATOR . $appName,
            __DIR__
        );
    }

    /**
     * Remove a directory recursively so long as it exist within
     * roady's Apps directory.
     *
     * This method is intended to be used to remove any Apps created
     * during testing.
     *
     * Note: If the specified $pathToTheAppsDirectory does not
     * contain the string `roady/Apps` in it's path, then the
     * directory will not be removed.
     *
     * @return void
     */
    private static function removeAppDirectory(string $pathToTheAppsDirectory): void
    {
        if (
            $pathToTheAppsDirectory !== '/'
            &&
            str_contains($pathToTheAppsDirectory, 'roady' . DIRECTORY_SEPARATOR . 'Apps')
            &&
            is_dir($pathToTheAppsDirectory)
        ) {
            $ls = scandir($pathToTheAppsDirectory);
            $contents = (is_array($ls) ? $ls : []);
            foreach ($contents as $item) {
                if ($item != "." && $item != "..") {
                    $itemPath = $pathToTheAppsDirectory . DIRECTORY_SEPARATOR . $item;
                    (is_dir($itemPath) === true && is_link($itemPath) === false)
                        ? self::removeAppDirectory($itemPath)
                        : unlink($itemPath);
                }
            }
            rmdir($pathToTheAppsDirectory);
        }
    }

    private function createTestApp(string $appName, string $domain): void
    {
        $rigExecutable = strval(realpath($this->determinePathToDdmsExecutable()));
        $this->assertTrue(
            file_exists($rigExecutable),
            'Could not create Test App because the rig binary at ' . $rigExecutable . ' does not exist. Make sure composer.json requires the most recent version of rig.'
        );
        $this->assertTrue(
            is_executable($rigExecutable),
            'Could not create Test App because the rig binary at ' . $rigExecutable . ' is not executable'
        );
        try {
            exec($rigExecutable . ' --new-app --name ' . $appName . ' --domain ' . $domain);
        } catch (Exception $e) {
            $this->assertFalse(true, 'Failed to create Test App because rig --new-app failed.');
        }

    }

    private function createTestOutputComponent(string $appName, string $domain): void
    {
        $rigExecutable = strval(realpath($this->determinePathToDdmsExecutable()));
        $ocName = $this->getRandomName('OutputComponent');
        $output = "$ocName Test App Output";
        $this->assertTrue(
            file_exists($rigExecutable),
            'Could not create Test App\'s OutputComponents because the rig binary at ' . $rigExecutable . ' does not exist. Make sure composer.json requires the most recent version of rig.'
        );
        $this->assertTrue(
            is_executable($rigExecutable),
            'Could not create Test App\'s OutputComponents because the rig binary at ' . $rigExecutable . ' is not executable'
        );
        try {
            exec($rigExecutable . ' --new-output-component --for-app ' . $appName . ' --name ' . $ocName . ' --output ' . $output . ' --container ' . $this->outputComponentContainer);
            $this->registerExpectedOutputComponent($ocName, $output);
        } catch (Exception $e) {
            $this->assertFalse(true, 'Failed to create Test App\'s OutputComponents because rig --new-output-component failed.');
        }

    }

    private function registerExpectedOutputComponent(string $name, string $output): void
    {
        $this->expectedOutputComponentNamesAndOutput[$name] = $output;
    }

    private function createTestRequest(string $appName, string $domain): void
    {
        $rigExecutable = strval(realpath($this->determinePathToDdmsExecutable()));
        $requestName = $this->getRandomName('Request');
        $relativeUrl = 'index.php';
        $this->assertTrue(
            file_exists($rigExecutable),
            'Could not create Test App\'s Requests because the rig binary at ' . $rigExecutable . ' does not exist. Make sure composer.json requires the most recent version of rig.'
        );
        $this->assertTrue(
            is_executable($rigExecutable),
            'Could not create Test App\'s Requests because the rig binary at ' . $rigExecutable . ' is not executable'
        );
        try {
            exec($rigExecutable . ' --new-request --for-app ' . $appName . ' --name ' . $requestName . ' --relative-url ' . '"' . $relativeUrl . '"' . ' --container ' . $this->requestContainer);
            $this->registerExpectedRequest($requestName, $relativeUrl);
        } catch (Exception $e) {
            $this->assertFalse(true, 'Failed to create Test App\'s Requests because rig --new-request failed.');
        }

    }

    private function registerExpectedRequest(string $name, string $relativeUrl): void
    {
        $this->expectedRequestNamesAndUrls[$name] = $relativeUrl;
    }

    private function createTestResponse(string $appName, string $domain): void
    {
        $rigExecutable = strval(realpath($this->determinePathToDdmsExecutable()));
        $responseName = $this->getRandomName('Response');
        $position = 4.2017;
        $this->assertTrue(
            file_exists($rigExecutable),
            'Could not create Test App\'s Responses because the rig binary at ' . $rigExecutable . ' does not exist. Make sure composer.json requires the most recent version of rig.'
        );
        $this->assertTrue(
            is_executable($rigExecutable),
            'Could not create Test App\'s Responses because the rig binary at ' . $rigExecutable . ' is not executable'
        );
        try {
            exec($rigExecutable . ' --new-response --for-app ' . $appName . ' --name ' . $responseName . ' --position ' . strval($position));
            $this->registerExpectedResponse($responseName, $position);
        } catch (Exception $e) {
            $this->assertFalse(true, 'Failed to create Test App\'s Responses because rig --new-response failed.');
        }

    }

    private function createTestGlobalResponse(string $appName, string $domain): void
    {
        $rigExecutable = strval(realpath($this->determinePathToDdmsExecutable()));
        $responseName = $this->getRandomName('GlobalResponse');
        $position = 4.2017;
        $this->assertTrue(
            file_exists($rigExecutable),
            'Could not create Test App\'s Responses because the rig binary at ' . $rigExecutable . ' does not exist. Make sure composer.json requires the most recent version of rig.'
        );
        $this->assertTrue(
            is_executable($rigExecutable),
            'Could not create Test App\'s Responses because the rig binary at ' . $rigExecutable . ' is not executable'
        );
        try {
            exec($rigExecutable . ' --new-global-response --for-app ' . $appName . ' --name ' . $responseName . ' --position ' . strval($position));
            $this->registerExpectedGlobalResponse($responseName, $position);
        } catch (Exception $e) {
            $this->assertFalse(true, 'Failed to create Test App\'s Responses because rig --new-response failed.');
        }

    }

    private function registerExpectedResponse(string $name, int|float $position): void
    {
        $this->expectedResponseNamesAndPositions[$name] = $position;
    }

    private function registerExpectedGlobalResponse(string $name, int|float $position): void
    {
        $this->expectedGlobalResponseNamesAndPositions[$name] = $position;
    }

    private function determinePathToDdmsExecutable(): string
    {
        return str_replace(
            'Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'utility' . DIRECTORY_SEPARATOR . 'TestTraits',
            'vendor' . DIRECTORY_SEPARATOR . 'darling' . DIRECTORY_SEPARATOR . 'rig' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'rig',
            __DIR__
        );
    }

}

