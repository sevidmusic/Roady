<?php

namespace roady\abstractions\component\UserInterface;

use roady\abstractions\component\UserInterface\ResponseUI as ResponseUIInterface;
use roady\classes\component\Web\App as CoreApp;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\UserInterface\WebUI as WebUIInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use RuntimeException as PHPRuntimeException;

abstract class WebUI extends ResponseUIInterface implements WebUIInterface
{

    private const DOCTYPE = '<!DOCTYPE html>' . PHP_EOL;
    private const OPEN_HTML = '<html lang="en">' . PHP_EOL;
    private const OPEN_HEAD = '<head>' . PHP_EOL;
    private const VIEWPORT = '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . PHP_EOL;
    private string $titleSprint = PHP_EOL . '<title>%s</title>' . PHP_EOL;
    private const CLOSE_HEAD = '</head>' . PHP_EOL;
    private const OPEN_BODY = '<body>' . PHP_EOL;
    private const CLOSE_BODY = '</body>' . PHP_EOL;
    private const CLOSE_HTML = '</html>' . PHP_EOL;

    /**
     * @var string $webUIOutput The collective output of all Responses
     * to the current request with html structure incorporated.
     */
    private string $webUIOutput = '';

    /**
     * @var string $rawCollectiveResponseOutput
     * The raw collective output of all Responses to the
     * current Request.
     *
     * It is necessary to track the collective raw output of all
     * Responses to make sure a RuntimeException is thrown if
     * the collective output of all Responses is empty.
     *
     * It would not be possible to check the $webUIOutput
     * to see if the collective output of all Responses
     * is empty since the $webUIOutput will have html
     * structure incorporated into it, so the unmodified
     * collective output of all Responses is tracked
     * by this property.
     */
    private string $rawCollectiveResponseOutput = '';

    public function getOutput(): string
    {
        #return parent::getOutput();
        $this->import(
            [
                'output' => $this->buildOutputWithHtmlStructure()
            ]
        );
        return (
            $this->getState() === true
            ? $this->export()['output']
            : ''
        );
    }

    private function closeHeadAndOpenBodyIfAppropriate(ResponseInterface $response): void
    {
        if(
            $this->responsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotClosedAndBodyNotOpened(
                $response
            )
        ) {
            $this->closeHeadOpenBody();
        }
    }
    private function buildOutputWithHtmlStructure(): string
    {
        /**
         * @devNote: Always reset $this->rawCollectiveResponseOutput
         * when $this->buildOutputWithHtmlStructure() is called to
         * prevent old collective Response output from being included
         * in the new collective Response output.
         */
        $this->rawCollectiveResponseOutput = '';
        $this->openHtml();
        $this->loadStylesheetsDefinedByBuiltApps();
        /**
         * @var ResponseInterface $response
         */
        foreach($this->getSortedResponsesToCurrentRequest() as $response)
        {
            $this->closeHeadAndOpenBodyIfAppropriate($response);
            $this->addResponseOutputToWebUIOutput($response);
        }
        $this->closeBodyCloseHtml();
        if(empty($this->rawCollectiveResponseOutput))
        {
            throw new PHPRuntimeException(
                'There is nothing to show for this request.'
            );
        }
        return $this->webUIOutput;
    }

    private function title(): string
    {
        return sprintf(
            $this->titleSprint,
            (
                $this->getRouter()
                     ->getRequest()
                     ->getGet()['request']
                ??
                $this->getRouter()
                     ->getRequest()
                     ->getName()
            )
        );
    }
    private function openHtml(): void
    {
        /** @devNote:
         * Always reset the $this->webUIOutput when $this->openHtml() is called,
         * i.e., use "=" not ".=" for assignment.
         */
        $this->webUIOutput =
            self::DOCTYPE .
            self::OPEN_HTML .
            self::OPEN_HEAD .
            $this->title() .
            self::VIEWPORT
        ;
    }

    private function loadStylesheetsDefinedByBuiltApps(): void
    {
        foreach ($this->determineBuiltAppNames() as $appName) {
            foreach($this->determineNamesOfStylesheetsThatShouldLoadForApp($appName) as $stylesheetName) {
                $this->webUIOutput .= '<link rel="stylesheet" href="Apps/' . $appName  . '/css/' . $stylesheetName . '">' . PHP_EOL;
            }
        }
    }

    /**
     * @return array<string, ResponseInterface> Sorted array of Responses to the current Request indexed by Response position.
     */
    private function getSortedResponsesToCurrentRequest(): array
    {
        $responsesToCurrentRequest = $this->router->getResponses(
            CoreApp::deriveAppLocationFromRequest($this->router->getRequest()),
            ResponseInterface::RESPONSE_CONTAINER
        );
        /** @var array <string, ResponseInterface> $sortedResponses */
        $sortedResponses = $this->sortPositionables(...$responsesToCurrentRequest);
        return $sortedResponses;
    }

    private function responsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotClosedAndBodyNotOpened(ResponseInterface $response): bool
    {
        return ($response->getPosition() >= 0 && !str_contains($this->webUIOutput, self::CLOSE_HEAD . self::OPEN_BODY));
    }

    private function closeHeadOpenBody(): void
    {
        $this->webUIOutput .= self::CLOSE_HEAD . self::OPEN_BODY;
    }

    private function addResponseOutputToWebUIOutput(ResponseInterface $response): void
    {
        $outputComponents = [];
        foreach($response->getOutputComponentStorageInfo() as $storable)
        {
            $component = $this->getRoutersComponentCrud()->read($storable);
            $classImplements = class_implements($component);
            $isAnOutputComponent = (is_array($classImplements) && in_array(OutputComponentInterface::class, $classImplements));
            if($isAnOutputComponent === true)
            {
                /**
                * @var OutputComponentInterface $component
                */
                array_push($outputComponents, $component);
            }
        }
        $sortedOutputComponents = $this->sortPositionables(...$outputComponents);
        /**
        * @var OutputComponentInterface $outputComponent
        */
        foreach($sortedOutputComponents as $outputComponent)
        {
            $this->webUIOutput .= $outputComponent->getOutput();
            $this->rawCollectiveResponseOutput .= $outputComponent->getOutput();
        }
    }

    private function closeBodyCloseHtml(): void
    {
        $this->webUIOutput .= self::CLOSE_BODY . self::CLOSE_HTML;
    }

    /**
     * @return array<int, string>
     */
    private function determineBuiltAppNames(): array
    {
        $builtAppNames = [];
        $factories = $this->getRoutersComponentCrud()->readAll(
            CoreApp::deriveAppLocationFromRequest($this->getRouter()->getRequest()),
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

    /**
     * @return array<int, string>
     */
    private function determineNamesOfStylesheetsThatShouldLoadForApp(string $appName): array
    {
        $stylesheetsToLoad = [];
        foreach($this->determineAppsDefinedStylesheetNames($appName) as $stylesheetName) {
            if($this->hasCssFileExtension($stylesheetName) && file_exists($this->determineStylesheetPath($appName, $stylesheetName))) {
                if($this->isAGlobalStylesheet($stylesheetName) || $this->stylesheetNameMatchesARequestQueryStringValue($stylesheetName)) {
                    array_push($stylesheetsToLoad, $stylesheetName);
                }
            }
        }
        return $stylesheetsToLoad;
    }

    private function stylesheetNameMatchesARequestQueryStringValue(string $stylesheetName): bool
    {
        $nameWithoutExtension = str_replace('.css', '', $stylesheetName);
        if(str_contains(strval(parse_url($this->getRouter()->getRequest()->getUrl(), PHP_URL_QUERY)), $nameWithoutExtension)) {
            return true;
        }
        return false;
    }

    private function isAGlobalStylesheet(string $stylesheetName): bool
    {
        return str_contains($stylesheetName, 'global');
    }

    private function determineStylesheetPath(string $appName, string $stylesheetName): string
    {
        return $this->determinePathToAppsCssDir($appName) . DIRECTORY_SEPARATOR . $stylesheetName;
    }

    private function hasCssFileExtension(string $stylesheetName): bool
    {
        return (pathinfo($stylesheetName, PATHINFO_EXTENSION) === 'css');
    }

    /**
     * Returns an array of the names of all the stylesheets defined by the specified App.
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

    private function determinePathToApp(string $appName): string
    {
        $replace = 'core' . DIRECTORY_SEPARATOR . 'abstractions' . DIRECTORY_SEPARATOR . 'component' . DIRECTORY_SEPARATOR . 'UserInterface';
        $path = strval(str_replace($replace, 'Apps' . DIRECTORY_SEPARATOR . $appName, strval(realpath(__DIR__))));
        return $path;
    }

    private function determinePathToAppsCssDir(string $appName): string
    {
        return $this->determinePathToApp($appName) . DIRECTORY_SEPARATOR . 'css';
    }

    private function isAAppComponentsFactory(ComponentInterface $component): bool {
        $implements = class_implements($component);
        if(is_array($implements)) {
            return in_array(AppComponentsFactoryInterface::class, $implements);
        }
        return false;
    }

}
