<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use roady\classes\component\Web\App as CoreApp;
use roady\classes\component\Web\Routing\Request as CoreRequest;
use roady\classes\primary\Positionable as CorePositionable;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\ResponseUI as ResponseUIInterface;
use roady\interfaces\component\UserInterface\WebUI as WebUIInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\interfaces\component\Web\Routing\Router as RouterInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException as PHPRuntimeException;
use rig\classes\command\ConfigureAppOutput;
use rig\classes\ui\CommandLineUI;

trait WebUITestTrait
{

    private WebUIInterface $webUI;
    private string $doctype = '<!DOCTYPE html>' . PHP_EOL;
    private string $openHtml = '<html lang="en">' . PHP_EOL;
    private string $openHead = '<head>' . PHP_EOL;
    private string $closeHead = '</head>' . PHP_EOL;
    private string $openBody = '<body>' . PHP_EOL;
    private string $closeBody = '</body>' . PHP_EOL;
    private string $closeHtml = '</html>' . PHP_EOL;
    private string $expectedOutput = '';
    private string $globalCssFileName = 'test-global-css-file.css';
    /** @var array<int, string> $createdApps Array of the names of the Apps that were created for WebUI tests. */
    private array $createdApps = [];
    private static string $requestedStylesheetNameA = 'requestedStylesheetNameA';
    private static string $requestedStylesheetNameB = 'requestedStylesheetNameB';

    /**
     * @devNote:
     * This overwrites the ResponseUITestTrait::expectedOutput() method.
     * @see Tests/Unit/abstractions/component/UserInterface/WebUITest.php
     */
    protected function expectedOutput(): string
    {
        $this->expectDoctypeOpeningHtmlAndOpeningHeadTags();
        $this->expectHtmlLinkTagsForGlobalCssFilesDefinedByBuiltApps();
        /**
         * @var ResponseInterface $response
         */
        foreach($this->getSortedResponsesExpectedByTest() as $response)
        {
            $this->expectHeadTagIsClosedAndBodyTagIsOpenedIfResponsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotAlreadyClosedAndBodyWasNotAlreadyOpened($response);
            $this->expectResponseOutput($response);
        }
        $this->expectClosingBodyAndClosingHtmlTags();
        return $this->expectedOutput;
    }

    private function getCurrentRequest(): RequestInterface
    {
        return $this->getWebUI()->getRouter()->getRequest();
    }

    /**
     * @return array<string, ResponseInterface>
     */
    private function getSortedResponsesExpectedByTest(): array
    {
        /** @var array<string, ResponseInterface> $sortedResponses */
        $sortedResponses = $this->sortPositionables(...$this->expectedResponses());
        return $sortedResponses;
    }

    /**
     * @param string $appName                   The name of the App to create.
     * @param array<int, string> $cssFileNames  The names of the css files to create.
     * @param bool $build                       If set to true, build the App, otherwise
     *                                          don't build the App.
     */
    private function createTestAppWithCssFiles(string $appName, array $cssFileNames, bool $build): void {

        $this->createTestApp($appName);
        foreach($cssFileNames as $cssFileName) {
            $this->createCssFileForSpecificRequestForApp($appName, $cssFileName);
        }
        if($build === true) {
            $this->buildApp($appName);
        }
    }

    private function expectHtmlLinkTagsForGlobalCssFilesDefinedByBuiltApps(): void
    {
        /**
         * This App is used to test that only Built Apps have links for there
         * global css files incorporated into the output. It is created, and a
         * global css file is defined for it, but it will not be built, therefore,
         * a link for it's global css file should not be incorporated into the output,
         * if it is, then the WebUI::getOutput() method is not properly implemented.
         */
        $this->createTestAppWithCssFiles(
            'IgnoredWebUITestApp' . strval(rand(100, PHP_INT_MAX)),
            ['should-NOT-LOAD-since-app-was-NOT-built-and-also-does-NOT-match-current-request.css', self::$requestedStylesheetNameA . '.css', self::$requestedStylesheetNameB . '.css', 'global-should-NOT-LOAD-since-app-was-NOT-built.css'],
            false
        );
        $this->createTestAppWithCssFiles(
            'BuiltWebUITestApp' . strval(rand(100, PHP_INT_MAX)),
            ['global-SHOULD-LOAD-since-app-was-built.css', self::$requestedStylesheetNameA . '.css', 'should-NOT-LOAD-since-does-NOT-match-current-request.css'],
            true
        );
        $this->createTestAppWithCssFiles(
            'BuiltWebUITestApp' . strval(rand(100, PHP_INT_MAX)),
            ['global-styles-SHOULD-LOAD-since-app-was-built.css', self::$requestedStylesheetNameA . '.css', self::$requestedStylesheetNameB . '.css', 'global-in-name-but-should-NOT-LOAD-because-extension-is-NOT-css'],
            true
        );
        /** There should only be links for global css files incorporated into the output for Apps that were built */
        $this->expectLinksForStylesheetsDefinedByBuiltApps();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        foreach($this->createdApps as $appName) {
            self::removeDirectory($this->determinePathToApp($appName));
        }
    }

    /**
     * Returns an array of the names of all of the stylesheets defined by the specified App.
     * @param string $appName The name of the App that defines the stylesheets.
     * @return array<int, string> Array of the names of the stylesheets defined by the specified App.
     */
    private function determineAppsDefinedStylesheetNames(string $appName) {
        if(is_dir($this->determinePathToAppsCssDir($appName))) {
            $ls = scandir($this->determinePathToAppsCssDir($appName));
            $definedStylesheets = array_diff((is_array($ls) ? $ls : []), ['.', '..']);
        }
        return ($definedStylesheets ?? []);
    }

    /**
     * An array of the names of the stylesheets that should have <links> created for them.
     * @return array<int, string> Array of the names of the stylesheets that should have <links> create for them.
     */
    private function determineNamesOfStylesheetsDefinedByAppThatShouldHaveLinksCreatedForThem(string $appName): array
    {
        $stylesheetsToLoad = [];
        foreach($this->determineAppsDefinedStylesheetNames($appName) as $stylesheetName) {
            if($this->hasCssFileExtension($stylesheetName) && file_exists($this->determineStylesheetPath($appName, $stylesheetName))) {
                if($this->stylesheetNameMathesARequestQueryStringValue($stylesheetName) || $this->isAGlobalStylesheet($stylesheetName)) {
                    array_push($stylesheetsToLoad, $stylesheetName);
                }
            }
        }
        return ($stylesheetsToLoad ?? []);
    }

    private function isAGlobalStylesheet(string $stylesheetName): bool
    {
        return str_contains($stylesheetName, 'global');
    }

    private function stylesheetNameMathesARequestQueryStringValue(string $stylesheetName): bool
    {
        $nameWithoutExtension = str_replace('.css', '', $stylesheetName);
        if(str_contains(strval(parse_url($this->getWebUI()->getRouter()->getRequest()->getUrl(), PHP_URL_QUERY)), $nameWithoutExtension)) {
            return true;
        }
        return false;
    }

    private function determineStylesheetPath(string $appName, string $stylesheetName): string
    {
        return $this->determinePathToAppsCssDir($appName) . DIRECTORY_SEPARATOR . $stylesheetName;
    }

    private function hasCssFileExtension(string $stylesheetName): bool
    {
        return (pathinfo($stylesheetName, PATHINFO_EXTENSION) === 'css');
    }

    private function expectLinksForStylesheetsDefinedByBuiltApps(): void
    {
        foreach($this->determineBuiltAppNames() as $appName) {
            foreach($this->determineNamesOfStylesheetsDefinedByAppThatShouldHaveLinksCreatedForThem($appName) as $stylesheetName) {
                $this->expectCssLinkForApp($appName, $stylesheetName);
            }
        }
    }

    /**
     * @return array<int, string> Array of the names of the Apps that are currenlty built
     */
    private function determineBuiltAppNames(): array
    {
        $builtAppNames = [];
        $factories = $this->getRoutersComponentCrud()->readAll(
            CoreApp::deriveAppLocationFromRequest($this->getWebUI()->getRouter()->getRequest()),
            FactoryInterface::CONTAINER
        );
        /**
         * @var FactoryInterface $factory
         */
        foreach($factories as $factory) {
            if($this->isAAppComponentsFactory($factory)) {
                /** @var AppComponentsFactoryInterface $factory */
                array_push($builtAppNames, $factory->getApp()->getName());
            }
        }
        return $builtAppNames;
    }

    private function isAAppComponentsFactory(ComponentInterface $component): bool {
        $implements = class_implements($component);
        if(is_array($implements)) {
            return in_array(AppComponentsFactoryInterface::class, $implements);
        }
        return false;
    }

    private function expectCssLinkForApp(string $appName, string $cssFileName): void
    {
        $this->expectedOutput .= '<link rel="stylesheet" href="Apps/' . $appName . '/css/' . $cssFileName . '">';
    }

    private function buildApp(string $appName): void
    {
        try {
            exec(PHP_BINARY . ' ' . escapeshellarg($this->determinePathToAppsComponentsPhp($appName)) . ' http://DEFAULT');
        } catch(PHPRuntimeException $e) { /** Failed to build App */ }
    }

    protected function setWebUIParentTestInstances(): void
    {
        $this->setResponseUI($this->getWebUI());
        $this->setResponseUIParentTestInstances();
    }

    public function getWebUI(): WebUIInterface
    {
        return $this->webUI;
    }

    public function setWebUI(WebUIInterface $webUI): void
    {
        $this->webUI = $webUI;
    }

    /**
     * @return array{0: StorableInterface, 1: SwitchableInterface, 2: PositionableInterface, 3: RouterInterface}
     */
    public function getWebUITestArgs(): array
    {
        return [
            new CoreStorable(
                'MockWebUIName',
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            self::getRouter()
        ];
    }

    private function expectDoctypeOpeningHtmlAndOpeningHeadTags(): void
    {
        $this->expectedOutput =
            $this->doctype .
            $this->openHtml .
            $this->openHead .
            '<title>' .
            (
                $this->getWebUI()->getRouter()->getRequest()->getGet()['request']
                ??
                $this->getRouter()->getRequest()->getUrl()
            ) .
            '</title>'
        ;
    }


    private function expectHeadTagIsClosedAndBodyTagIsOpenedIfResponsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotAlreadyClosedAndBodyWasNotAlreadyOpened(ResponseInterface $response): void
    {
        if($response->getPosition() >= 0 && !str_contains($this->expectedOutput, $this->closeHead . $this->openBody)) {
            $this->expectedOutput .= $this->closeHead . $this->openBody;
        }
    }

    private function createTestApp(string $appName): void
    {
        $configureAppOutput = new ConfigureAppOutput();
        $configureAppOutput->run(
            new CommandLineUI(),
            $configureAppOutput->prepareArguments(
                [
                    '--for-app',
                    $appName,
                    '--name',
                    'WebUITestAppOutput',
                    '--output',
                    'Web UI Test App Output',
                ]
            )
        );
        array_push($this->createdApps, $appName);
    }

    private function determinePathToApp(string $appName): string
    {
        $replace = 'Tests' . DIRECTORY_SEPARATOR . 'Unit' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR . 'TestTraits';
        return strval(str_replace($replace, 'Apps' . DIRECTORY_SEPARATOR . $appName, strval(realpath(__DIR__))));
    }

    private function determinePathToAppsCssDir(string $appName): string
    {
        return $this->determinePathToApp($appName) . DIRECTORY_SEPARATOR . 'css';
    }

    private function determinePathToAppsComponentsPhp(string $appName): string
    {
        return $this->determinePathToApp($appName) . DIRECTORY_SEPARATOR . 'Components.php';
    }

    private function createCssFileForSpecificRequestForApp(string $appName, string $requestName): void
    {
        if(!is_dir($this->determinePathToAppsCssDir($appName))) {
            mkdir($this->determinePathToAppsCssDir($appName));
        }
        file_put_contents($this->determinePathToAppsCssDir($appName) . DIRECTORY_SEPARATOR . $requestName, ' body { font-family: monospace; }', LOCK_SH);
    }

    private static function removeDirectory(string $dir): void
    {
        if ($dir !== '/' && is_dir($dir)) {
            $ls = scandir($dir);
            $contents = (is_array($ls) ? $ls : []);
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

    private function expectClosingBodyAndClosingHtmlTags(): void
    {
        $this->expectedOutput .= $this->closeBody . $this->closeHtml;
    }

    private function expectResponseOutput(ResponseInterface $response): void
    {
        /** @var array<int, OutputComponentInterface> $outputComponents */
        $outputComponents = [];
        foreach($response->getOutputComponentStorageInfo() as $storable)
        {
            /**
             * @var OutputComponentInterface $component
             */
            $component = $this->getRoutersComponentCrud()->read($storable);
            if($this->isProperImplementation(OutputComponentInterface::class, $component))
            {
                array_push($outputComponents, $component);
            }
        }
        $sortedOutputComponents = $this->sortPositionables(...$outputComponents);
        /**
         * @var OutputComponentInterface $outputComponent
         */
        foreach($sortedOutputComponents as $outputComponent)
        {
            $this->expectedOutput .= $outputComponent->getOutput();
        }
    }

    public static function getRequest(): RequestInterface
    {
        $request = new CoreRequest(
            new CoreStorable(
                'ResponseUICurrentRequest' . strval(rand(0, 999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable()
        );
        $request->import(['url' => './?request=' . self::$requestedStylesheetNameA . '&request=' . self::$requestedStylesheetNameB]);
        return $request;
    }

}
