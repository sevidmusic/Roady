<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\interfaces\component\UserInterface\WebUI as WebUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException as PHPRuntimeException;
use ddms\classes\command\ConfigureAppOutput;
use ddms\classes\ui\CommandLineUI;

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
    /**
     * @var array<int, string> $builtAppNames
     */
    private array $builtAppNames = [];

    /**
     * @devNote:
     * This overwrites the ResponseUITestTrait::expectedOutput() method.
     * @see Tests/Unit/abstractions/component/UserInterface/WebUITest.php
     */
    protected function expectedOutput(): string
    {
        $this->expectDoctypeOpeningHtmlAndOpeningHeadTags();
        $this->expectHtmlLinkTagsForGlobalCssFilesDefinedByRunningApps();
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

    private function expectHtmlLinkTagsForGlobalCssFilesDefinedByRunningApps(): void
    {
        /** @var string $appThatWasNotBuilt
         * This App is used to test that only Running Apps have links for there
         * global css files incorporated into the output. It is created, and a
         * global css file is defined for it, but it will not be built, therefore,
         * a link for it's global css file should not be incorporated into the output,
         * if it is, then the WebUI::getOutput() method is not properly implemented.
         */
        $appThatWasNotBuilt = 'IgnoredWebUITestApp' . strval(rand(100, PHP_INT_MAX));
        $this->createTestApp($appThatWasNotBuilt);
        $this->createGlobalCssFileForApp($appThatWasNotBuilt);
        $firstAppBuilt = 'BuiltWebUITestApp' . strval(rand(100, PHP_INT_MAX));;
        $this->createTestApp($firstAppBuilt);
        $this->createGlobalCssFileForApp($firstAppBuilt);
        $this->buildApp($firstAppBuilt);
        $secondAppBuilt = 'BuiltWebUITestApp' . strval(rand(100, PHP_INT_MAX));;
        $this->createTestApp($secondAppBuilt);
        $this->createGlobalCssFileForApp($secondAppBuilt);
        $this->buildApp($secondAppBuilt);
        /** There should only be links for global css files incorporated into the output for Apps that were built */
// HERE        $this->expectGlobalCssLinksForApp($firstAppBuilt);
// HERE        $this->expectGlobalCssLinksForApp($secondAppBuilt);
        self::removeDirectory($this->determinePathToApp($firstAppBuilt));
        self::removeDirectory($this->determinePathToApp($secondAppBuilt));
        self::removeDirectory($this->determinePathToApp($appThatWasNotBuilt));
    }

    private function expectGlobalCssLinksForApp(string $appName): void
    {
        $this->expectedOutput .= '<link rel="stylesheet" href="Apps/' . $appName . '/css/' . $this->globalCssFileName . '">';
    }

    private function buildApp(string $appName): void
    {
        exec(PHP_BINARY . ' ' . escapeshellarg($this->determinePathToAppsComponentsPhp($appName)));
        array_push($this->builtAppNames, $appName);
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
        $this->expectedOutput = $this->doctype . $this->openHtml . $this->openHead;
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

    private function createGlobalCssFileForApp(string $appName): void
    {
        if(!is_dir($this->determinePathToAppsCssDir($appName))) {
            mkdir($this->determinePathToAppsCssDir($appName));
        }
        file_put_contents($this->determinePathToAppsCssDir($appName) . DIRECTORY_SEPARATOR . $this->globalCssFileName, ' body { background: #020203; color: aqua; font-family: monospace; }');
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

}
