<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Component;
use roady\interfaces\component\Factory\App\AppComponentsFactory;
use roady\interfaces\component\Factory\Factory;
use roady\interfaces\component\OutputComponent;
use roady\interfaces\component\UserInterface\WebUI;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Web\Routing\Response;
use RuntimeException;
use rig\classes\command\ConfigureAppOutput;
use rig\classes\ui\CommandLineUI;

/**
 * @devNote The following use statements are here for
 *          PhpStan, these interfaces indicate the expected
 *          parameter types for the getWebUITestArgs() method,
 *          PhpStan complains if these use statements are not
 *          here.
 */
use roady\interfaces\component\Web\Routing\Router as RouterInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;


/**
 * private function addResponseOutputToExpectedOutput(Response $response, string &$expectedOutput): void
 * private function buildApp(string $appName): void
 * private function closeHeadAndOpenBodyIfAppropriate(Response $response, string &$expectedOutput): void
 * private function createCssFileForApp(string $appName,string $cssFileName): void
 * private function createTestApp(string $appName): void
 * private function createTestAppWithCssFiles(string $appName,array $cssFileNames,bool $build): void
 * private function determineAppsDefinedStylesheetNames(string $appName): array
 * private function determineNamesOfStylesheetsDefinedByAppThatShouldHaveLinksCreatedForThem(string $appName): array
 * private function determinePathToApp(string $appName): string
 * private function determinePathToAppsComponentsPhp(string $appName): string
 * private function determinePathToAppsCssDir(string $appName): string
 * private function determineStylesheetPath(string $appName,string $stylesheetName): string
 * private function expectedTitle(): string
 * private function getExpectedResponsesSortedByPosition(): array
 * private function getSortedResponsesExpectedByTest(): array
 * private function hasCssFileExtension(string $stylesheetName): bool
 * private function isAAppComponentsFactory(Component $component): bool
 * private function isAGlobalStylesheet(string $stylesheetName): bool
 * private function openHtml(string &$expectedOutput): void
 * private function stylesheetNameMathesARequestQueryStringValue(string $stylesheetName): bool
 * private static function getUniqueName(): string
 * private static function removeAppDirectory(string $dir): void
 * private static function removeFile(string $path): void
 * protected function expectedOutput(): string
 * protected function setWebUIParentTestInstances(): void
 * public function getWebUI(): WebUI
 * public function getWebUITestArgs(): array
 * public function setWebUI(WebUI $webUI): void
 * public function tearDown(): void
 * public static function getRequest(): RequestInterface
 */

/**
 * The WebUITestTrait is intended to be used in conjunction
 * with the ResponseUITestTrait to test implementations of
 * the WebUI interface.
 *
 * The WebUITestTrait implements it's own expectedOutput()
 * method which is intended to replace the expectedOutput()
 * method defined by the ResponseUITestTrait.
 *
 * The WebUI does not modify or provide any additional tests
 * of it's own, it only overwrites the ResponseUITestTrait's
 * expectedOutput() method to accommodate the additional
 * expectations of a WebUI's getOutput() method's output.
 *
 * The WebUITestTrait also overwrites the ResponseUITestTrait's
 * getRequest() method to set up an appropriate Request for
 * testing the WebUI.
 *
 * Note: Make sure to include the following when using this
 * Trait in conjunction with the ResponseUITestTrait.
 *
 * ```
 * use ResponseUITestInterface, WebUITestInterface {
 *     WebUITestInterface::expectedOutput insteadof ResponseUITestInterface;
 *     WebUITestInterface::getRequest insteadof ResponseUITestInterface;
 * }
 * ```
 */
trait WebUITestTrait
{

    private WebUI $webUI;
    private string $doctype = '<!DOCTYPE html>' . PHP_EOL;
    private string $openHtml = '<html lang="en">' . PHP_EOL;
    private string $openHead = '<head>' . PHP_EOL;
    private string $titleSprint =
        PHP_EOL . '<title>%s</title>' . PHP_EOL;
    private string $viewport =
        '<meta name="viewport" ' .
        'content="width=device-width, initial-scale=1.0"' .
        '>' . PHP_EOL;
    private string $closeHead = '</head>' . PHP_EOL;
    private string $openBody = '<body>' . PHP_EOL;
    private string $closeBody = '</body>' . PHP_EOL;
    private string $closeHtml = '</html>' . PHP_EOL;
    private string $expectedOutput = '';
    private static string $globalCssFileName = 'test-global-css-file.css';
    /**
     * @var array<int, string> $createdApps Array of the names of
     *                                      the Apps that were
     *                                      created for WebUI tests.
     */
    private array $createdApps = [];
    private static string $requestedStylesheetNameA =
        'WebUITestTraitRequestedStylesheetNameA.css';
    private static string $requestedStylesheetNameB =
        'WebUITestTraitRequestedStylesheetNameB.css';

    private function addResponseOutputToExpectedOutput(
        Response $response,
        string &$expectedOutput
    ): void
    {
            $outputComponents = [];
            foreach(
                $response->getOutputComponentStorageInfo()
                as
                $storable
            )
            {
                /**
                 * @var OutputComponent $component
                 */
                $component = $this->getRoutersComponentCrud()
                                  ->read($storable);
                if(
                    $this->isProperImplementation(
                        OutputComponent::class,
                        $component
                    )
                )
                {
                    array_push($outputComponents, $component);
                }
            }
            $sortedOutputComponents = $this->sortPositionables(
                ...$outputComponents
            );
            /**
             * @var OutputComponent $outputComponent
             */
            foreach($sortedOutputComponents as $outputComponent)
            {
                $expectedOutput .= $outputComponent->getOutput();
            }
    }

    private function buildApp(string $appName): void
    {
        error_log('Attempting to build app: ' . $appName);
        try {
            exec(
                PHP_BINARY .
                ' ' .
                escapeshellarg(
                    $this->determinePathToAppsComponentsPhp(
                        $appName
                    )
                ) .
                " '" . self::$testDomain . "'"
            );
            error_log('Built app: ' . $appName);
        } catch(RuntimeException $e) {
            /** Failed to build App */
            error_log(
                'Failed to build app: ' .
                $appName .
                PHP_EOL .
                'Error: ' .
                $e->getMessage()
            );
        }
    }

    private function closeHeadAndOpenBodyIfAppropriate(
        Response $response,
        string &$expectedOutput
    ): void
    {
        if(
            $response->getPosition() >= 0
            &&
            !str_contains(
                $expectedOutput,
                $this->closeHead . $this->openBody
            )
        ) {
            $expectedOutput .= $this->closeHead . $this->openBody;
        }
    }

    /**
     * Create a css file for the specified App.
     *
     * Note: The App must exist.
     *
     * @param string $appName     The name of the App to create the
     *                            css file for.
     *
     * @param string $cssFileName The name to assign to the css
     *                            file. Make sure to include the
     *                            `.css` extension.
     *
     * @return void
     */
    private function createCssFileForApp(
        string $appName,
        string $cssFileName
    ): void
    {
        if(!is_dir($this->determinePathToAppsCssDir($appName))) {
            mkdir($this->determinePathToAppsCssDir($appName));
        }
        file_put_contents(
            $this->determinePathToAppsCssDir($appName) .
                DIRECTORY_SEPARATOR .
                $cssFileName,
            ' body { font-family: monospace; }',
            LOCK_SH
        );
    }

    private function relativeUrlOfTestRequest(): string
    {
        return substr(
            $this->getWebUI()->getRouter()->getRequest()->getUrl(),
            strpos(
                $this->getWebUI()->getRouter()->getRequest()->getUrl(),
                "?"
            ) + 1
        );
    }

    private function createTestApp(string $appName): void
    {
        error_log($this->relativeUrlOfTestRequest());
        $configureAppOutput = new ConfigureAppOutput();
        $configureAppOutput->run(
            new CommandLineUI(),
            $configureAppOutput->prepareArguments(
                [
                    '--for-app',
                    $appName,
                    '--name',
                    $this->getUniqueName(),
                    '--output',
                    'Web UI Test App Output',
                    '--relative-urls',
                    '?' . $this->relativeUrlOfTestRequest()
                ]
            )
        );
        array_push($this->createdApps, $appName);
    }

    /**
     * Create a Test App with css files.
     *
     * @param string $appName                   The name of the App
     *                                          to create.
     *
     * @param array<int, string> $cssFileNames  The names of the css
     *                                          files to create.
     *
     * @param bool $build                       If set to true, build
     *                                          the App, otherwise
     *                                          don't build the App.
     */
    private function createTestAppWithCssFiles(
        string $appName,
        array $cssFileNames,
        bool $build
    ): void {

        $this->createTestApp($appName);
        foreach($cssFileNames as $cssFileName) {
            $this->createCssFileForApp(
                $appName,
                $cssFileName
            );
        }
        if($build === true) {
            $this->buildApp($appName);
        }
    }

    /**
     * Returns an array of the names of all of the stylesheets
     * defined by the specified App.
     *
     * @param string $appName     The name of the App that defines
     *                            the stylesheets.
     *
     * @return array<int, string> Array of the names of the
     *                            stylesheets defined by the specified App.
     */
    private function determineAppsDefinedStylesheetNames(
        string $appName
    ): array {
        if(is_dir($this->determinePathToAppsCssDir($appName))) {
            $ls = scandir($this->determinePathToAppsCssDir($appName));
            $definedStylesheets = array_diff(
                (is_array($ls) ? $ls : []),
                ['.', '..']
            );
        }
        return ($definedStylesheets ?? []);
    }

    /**
     * An array of the names of the stylesheets that should have
     * <link> tags created for them.
     *
     * @return array<int, string> Array of the names of the
     *                            stylesheets that should have
     *                            <link> tags created for them.
     */
    private function determineNamesOfStylesheetsDefinedByAppThatShouldHaveLinksCreatedForThem(
        string $appName
    ): array
    {
        $requestedStylesheetsToLoad = [];
        $globalStylesheetsToLoad = [];
        foreach(
            $this->determineAppsDefinedStylesheetNames(
                $appName
            )
            as
            $stylesheetName
        ) {
            if(
                $this->hasCssFileExtension($stylesheetName)
                &&
                file_exists(
                    $this->determineStylesheetPath(
                        $appName,
                        $stylesheetName
                    )
                )
            ) {
                if(
                    $this->stylesheetNameMathesARequestQueryStringValue(
                        $stylesheetName
                    )
                    ||
                    $this->isAGlobalStylesheet($stylesheetName)
                ) {
                    (
                        $this->isAGlobalStylesheet($stylesheetName)
                        ? array_push($globalStylesheetsToLoad, $stylesheetName)
                        : array_push($requestedStylesheetsToLoad, $stylesheetName)
                    );
                }
            }
        }
        sort($globalStylesheetsToLoad);
        sort($requestedStylesheetsToLoad);
        return array_merge($globalStylesheetsToLoad, $requestedStylesheetsToLoad);
    }

    private function determinePathToApp(string $appName): string
    {
        return strval(
            str_replace(
                'Tests' .
                DIRECTORY_SEPARATOR .
                'Unit' .
                DIRECTORY_SEPARATOR .
                'interfaces' .
                DIRECTORY_SEPARATOR .
                'component' .
                DIRECTORY_SEPARATOR .
                'UserInterface' .
                DIRECTORY_SEPARATOR .
                'TestTraits',
                'Apps' . DIRECTORY_SEPARATOR . $appName,
                strval(realpath(__DIR__))
            )
        );
    }

    private function determinePathToAppsComponentsPhp(
        string $appName
    ): string
    {
        return
            $this->determinePathToApp($appName) .
            DIRECTORY_SEPARATOR .
            'Components.php';
    }

    private function determinePathToAppsCssDir(
        string $appName
    ): string
    {
        return
            $this->determinePathToApp($appName) .
            DIRECTORY_SEPARATOR .
            'css';
    }

    private function determineStylesheetPath(
        string $appName,
        string $stylesheetName
    ): string
    {
        return
            $this->determinePathToAppsCssDir($appName) .
            DIRECTORY_SEPARATOR .
            $stylesheetName;
    }

    private function expectedTitle(): string
    {
        return sprintf(
            $this->titleSprint,
            (
                $this->getWebUI()
                     ->getRouter()
                     ->getRequest()
                     ->getGet()['request']
                ??
                $this->getWebUI()
                     ->getRouter()
                     ->getRequest()
                     ->getName()
            )
        );
    }

    /**
     * @return array<int, Response>
     */
    private function getExpectedResponsesSortedByPosition(): array
    {
        /**
         * @var array<int, Response> $expectedResponses
         */
        $expectedResponses = $this->expectedResponses();
        /**
         * @var array<int, Response> $sortedResponses
         */
        $sortedResponses = $this->sortPositionables(...$expectedResponses);
        return $sortedResponses;
    }

    private function hasCssFileExtension(string $stylesheetName): bool
    {
        return (
            pathinfo($stylesheetName, PATHINFO_EXTENSION) === 'css'
        );
    }


    private function isAAppComponentsFactory(
        Component $component
    ): bool {
        $implements = class_implements($component);
        if(is_array($implements)) {
            return in_array(AppComponentsFactory::class, $implements);
        }
        return false;
    }


    private function isAGlobalStylesheet(string $stylesheetName): bool
    {
        return str_contains($stylesheetName, 'global');
    }

    private function openHtml(string &$expectedOutput): void
    {
        $expectedOutput =
            $this->doctype .
            $this->openHtml .
            $this->openHead .
            $this->expectedTitle() .
            $this->viewport;
    }

    private function stylesheetNameMathesARequestQueryStringValue(
        string $stylesheetName
    ): bool
    {
        $nameWithoutExtension = str_replace(
            '.css',
            '',
            $stylesheetName
        );
        if(
            str_contains(
                strval(
                    parse_url(
                        $this->getWebUI()
                             ->getRouter()
                             ->getRequest()
                             ->getUrl(),
                         PHP_URL_QUERY
                    )
                ),
                $nameWithoutExtension
            )
        ) {
            return true;
        }
        return false;
    }

    private static function getUniqueName(
        string|null $type = null
    ): string
    {
        return
            'WebUITestTrait' .
            ($type ?? 'Component') .
            'Name' .
            strval(rand(1000, 20000));
    }

    private static function removeAppDirectory(string $dir): void
    {
        if (
            $dir !== '/'
            &&
            str_contains($dir, 'roady' . DIRECTORY_SEPARATOR . 'Apps')
            &&
            is_dir($dir)
        ) {
            $ls = scandir($dir);
            $contents = (is_array($ls) ? $ls : []);
            foreach ($contents as $item) {
                if ($item != "." && $item != "..") {
                    $itemPath = $dir . DIRECTORY_SEPARATOR . $item;
                    match(
                        is_dir($itemPath) === true
                        &&
                        is_link($itemPath) === false
                    )
                    {
                        true => self::removeAppDirectory($itemPath),
                        default => self::removeFile($itemPath),
                    };
                }
            }
            rmdir($dir);
        }
    }

    private static function removeFile(string $path): void
    {
        unlink($path);
    }

    /**
     * @devNote:
     * This overwrites the ResponseUITestTrait::expectedOutput() method.
     * @see Tests/Unit/abstractions/component/UserInterface/WebUITest.php
     */
    protected function expectedOutput(): string
    {
        $this->createTestAppWithCssFiles(
            $this->getUniqueName(),
            [
                self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                self::$requestedStylesheetNameA,
                self::$requestedStylesheetNameB,
            ],
            false
        );
        /**
         * Create Test App with a global stylesheet, and build it.
         *
         * This stylesheet should be incorporated.
         */
        $this->createTestAppWithCssFiles(
            $this->getUniqueName(),
            [
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
            ],
            true
        );
        $this->createTestAppWithCssFiles(
            $this->getUniqueName(),
            [
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                $this->getUniqueName('Stylesheet') . self::$globalCssFileName,
                self::$requestedStylesheetNameA,
                self::$requestedStylesheetNameB,
            ],
            true
        );
        $expectedOutput = '';
        $this->openHtml($expectedOutput);
        /**
         * 1. Expect stylesheets (and js files,
         *    once css files are handled)
         * 2. Create a test App with css files
         * 3. For each expected css file, add a link tag
         *    to the $expectedOutput. This must happen
         *    before the head is closed and body is
         *    opened.
         */
        foreach($this->createdApps as $appName) {
            foreach($this->determineNamesOfStylesheetsDefinedByAppThatShouldHaveLinksCreatedForThem($appName) as $stylesheetName) {
                $expectedOutput .= '<link rel="stylesheet" href="' . $this->determineStylesheetPath($appName, $stylesheetName) . '">' . PHP_EOL;
            }
        }
        foreach(
            $this->getExpectedResponsesSortedByPosition() as $response
        )
        {
            $this->closeHeadAndOpenBodyIfAppropriate(
                $response,
                $expectedOutput
            );
            $this->addResponseOutputToExpectedOutput(
                $response,
                $expectedOutput
            );
        }
        $expectedOutput .= match(
            !str_contains(
                $expectedOutput,
                $this->closeHead . $this->openBody
            )
        ) {
            true =>
                $this->closeHead .
                $this->openBody .
                $this->closeBody .
                $this->closeHtml,
            default =>
                $this->closeBody .
                $this->closeHtml,
        };
        error_log($expectedOutput);
        return $expectedOutput;
    }

    protected function setWebUIParentTestInstances(): void
    {
        $this->setResponseUI($this->getWebUI());
        $this->setResponseUIParentTestInstances();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        foreach($this->createdApps as $appName) {
            self::removeAppDirectory(
                $this->determinePathToApp($appName)
            );
        }
        foreach(
            $this->getWebUI()
                 ->getRouter()
                 ->getCrud()
                 ->readAll(
                     App::deriveAppLocationFromRequest(
                         $this->getWebUI()
                              ->getRouter()
                              ->getRequest()
                     ),
                     Factory::CONTAINER
                 )
                 as
                 $appComponentsFactory
        ) {
            /**
             * @var AppComponentsFactory $appComponentsFactory
             */
            if($this->isAAppComponentsFactory($appComponentsFactory))
            {
                foreach($appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents() as $component) {
                    $this->getWebUI()
                         ->getRouter()
                         ->getCrud()
                         ->delete($component);
                }
                $this->getWebUI()
                     ->getRouter()
                     ->getCrud()
                     ->delete($appComponentsFactory);
            }
        }
    }

    public function getWebUI(): WebUI
    {
        return $this->webUI;
    }

    /**
     * @return array{
     *             0: StorableInterface,
     *             1: SwitchableInterface,
     *             2: PositionableInterface,
     *             3: RouterInterface
     *         }
     */
    public function getWebUITestArgs(): array
    {
        return [
            new Storable(
                'MockWebUIName',
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new Switchable(),
            new Positionable(),
            self::getRouter()
        ];
    }

    public function setWebUI(WebUI $webUI): void
    {
        $this->webUI = $webUI;
    }


    public static function getRequest(): RequestInterface
    {
        $request = new Request(
            new Storable(
                self::getUniqueName('Request'),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new Switchable()
        );
        $request->import(
            [
                'url' =>
                    self::$testDomain . '/?request=' .
                    str_replace('.css', '', self::$requestedStylesheetNameA) .
                    '&request=' .
                    str_replace('.css', '', self::$requestedStylesheetNameB)
            ]
        );
        return $request;
    }

}

/**
 * @return array<int, string>
 *
private function determineNamesOfStylesheetsThatShouldLoadForApp(string $appName): array
{
    $requestedStylesheetsToLoad = [];
    $globalStylesheetsToLoad = [];
    foreach($this->determineAppsDefinedStylesheetNames($appName) as $stylesheetName) {
        if($this->hasCssFileExtension($stylesheetName) && file_exists($this->determineStylesheetPath($appName, $stylesheetName))) {
            if($this->isAGlobalStylesheet($stylesheetName) || $this->stylesheetNameMatchesARequestQueryStringValue($stylesheetName)) {
                ($this->isAGlobalStylesheet($stylesheetName) ? array_push($globalStylesheetsToLoad, $stylesheetName) : array_push($requestedStylesheetsToLoad, $stylesheetName));
            }
        }
    }
    sort($globalStylesheetsToLoad);
    sort($requestedStylesheetsToLoad);
    return array_merge($globalStylesheetsToLoad, $requestedStylesheetsToLoad);
}
 */
