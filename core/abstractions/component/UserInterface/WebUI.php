<?php

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\Factory as FactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\UserInterface\WebUI as WebUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use RuntimeException as PHPRuntimeException;

abstract class WebUI extends ResponseUIInterface implements WebUIInterface
{

    private const CLOSEBODY = '</body>' . PHP_EOL;
    private const CLOSEHEAD = '</head>' . PHP_EOL;
    private const CLOSEHTML = '</html>' . PHP_EOL;
    private const DOCTYPE = '<!DOCTYPE html>' . PHP_EOL;
    private const OPENBODY = '<body>' . PHP_EOL;
    private const OPENHEAD = '<head>' . PHP_EOL;
    private const OPENHTML = '<html lang="en">' . PHP_EOL;

    /**
     * @var string $webUIOutput The collective ouput of all Responses to the
     * current request, with html structure added..
     */
    private string $webUIOutput = '';

    /**
     * @var string $collectiveResponseOutput
     * The raw collective output of all Responses to the current Request.
     */
    private string $collectiveResponseOutput = '';

    public function getOutput(): string
    {
        $this->import(['output' => $this->buildOutputWithHtmlStructure()]);
        return ($this->getState() === true ? $this->export()['output'] : '');
    }

    private function buildOutputWithHtmlStructure(): string
    {
        /** @devNote: Always reset $this->collectiveResponseOutput when $this->buildOutputWithHtmlStructure() is called. */
        $this->collectiveResponseOutput = '';
        $this->openHtml();
        $this->loadStylesheetsDefinedByBuiltApps();
        /**
         * @var ResponseInterface $response
         */
        foreach($this->getSortedResponsesToCurrentRequest() as $response)
        {
            if($this->responsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotClosedAndBodyNotOpened($response)) {
                $this->closeHeadOpenBody();
            }
            $this->addResponseOutputToWebUIOutput($response);
        }
        $this->closeBodyCloseHtml();
        if(empty($this->collectiveResponseOutput))
        {
            throw new PHPRuntimeException('There is nothing to show for this request.');
        }
        return $this->webUIOutput;
    }

    private function openHtml(): void
    {
        /** @devNote:
         * Always reset the $this->webUIOutput when $this->openHtml() is called,
         * i.e., use "=" not ".=" for assignment.
         */
        $this->webUIOutput = self::DOCTYPE . self::OPENHTML . self::OPENHEAD;
    }

    private function loadStylesheetsDefinedByBuiltApps(): void
    {
        foreach ($this->determineBuiltAppNames() as $appName) {
            foreach($this->determineNamesOfStylesheetsThatShouldLoadForApp($appName) as $stylesheetName) {
                $this->webUIOutput .= '<link rel="stylesheet" href="Apps/' . $appName  . '/css/' . $stylesheetName . '">';
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
        $sortedResponses = $this->sortPositionables(...$responsesToCurrentRequest);;
        return $sortedResponses;
    }

    private function responsePositionIsGreaterThanOrEqualToZeroAndHeadWasNotClosedAndBodyNotOpened(ResponseInterface $response): bool
    {
        return ($response->getPosition() >= 0 && !str_contains($this->webUIOutput, self::CLOSEHEAD . self::OPENBODY));
    }

    private function closeHeadOpenBody(): void
    {
        $this->webUIOutput .= self::CLOSEHEAD . self::OPENBODY;
    }

    private function addResponseOutputToWebUIOutput(ResponseInterface $response): void
    {
        $outputComponents = [];
        foreach($response->getOutputComponentStorageInfo() as $storable)
        {
            $component = $this->getRoutersComponentCrud()->read($storable);
            $classImplements = class_implements($component);
            $isAnOutputComponent = (is_array($classImplements) ? in_array(OutputComponentInterface::class, $classImplements) : false);
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
            $this->collectiveResponseOutput .= $outputComponent->getOutput();
        }
    }

    private function closeBodyCloseHtml(): void
    {
        $this->webUIOutput .= self::CLOSEBODY . self::CLOSEHTML;
    }

    /**
     * @return array<int, string>
     */
    private function determineBuiltAppNames(): array
    {
        $builtAppNames = [];
        $factories = $this->getRoutersComponentCrud()->readAll(
            CoreApp::deriveAppLocationFromRequest($this->getRouter()->getRequest()),
            AppComponentsFactoryInterface::CONTAINER
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
            if(pathinfo($stylesheetName, PATHINFO_EXTENSION) === 'css' && file_exists($this->determinePathToAppsCssDir($appName) . DIRECTORY_SEPARATOR . $stylesheetName) && str_contains($stylesheetName, 'global')) {
                array_push($stylesheetsToLoad, $stylesheetName);
            }
        }
        var_dump($stylesheetsToLoad);
        return $stylesheetsToLoad;
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
