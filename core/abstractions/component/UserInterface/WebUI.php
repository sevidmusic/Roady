<?php

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\interfaces\component\UserInterface\WebUI as WebUIInterface;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use RuntimeException as PHPRuntimeException;



abstract class WebUI extends ResponseUIInterface implements WebUIInterface
{

    private const DOCTYPE = '<!DOCTYPE html>' . PHP_EOL;
    private const OPENHTML = '<html lang="en">' . PHP_EOL;
    private const OPENHEAD = '<head>' . PHP_EOL;
    private const CLOSEHEAD = '</head>' . PHP_EOL;
    private const OPENBODY = '<body>' . PHP_EOL;
    private const CLOSEBODY = '</body>' . PHP_EOL;
    private const CLOSEHTML = '</html>' . PHP_EOL;

    private function buildOutputWithHtmlStructure(): string
    {
        $expectedOutput = self::DOCTYPE . self::OPENHTML . self::OPENHEAD;
        $actualOutput = '';
        $expectedResponses = $this->router->getResponses(
            CoreApp::deriveNameLocationFromRequest($this->router->getRequest()),
            ResponseInterface::RESPONSE_CONTAINER
        );
        $sortedResponses = $this->sortPositionables(...$expectedResponses);;
        /**
         * @var ResponseInterface $response
         */
        foreach($sortedResponses as $response)
        {
            if($response->getPosition() >= 0 && !str_contains($expectedOutput, self::CLOSEHEAD . self::OPENBODY)) {
                $expectedOutput .= self::CLOSEHEAD . self::OPENBODY;
            }
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
                $expectedOutput .= $outputComponent->getOutput();
                $actualOutput .= $outputComponent->getOutput();
            }
        }
        if(empty($actualOutput))
        {
            throw new PHPRuntimeException('There is nothing to show for this request.');
        }
        return $expectedOutput . self::CLOSEBODY . self::CLOSEHTML;
    }

    public function getOutput(): string
    {
        $this->import(['output' => $this->buildOutputWithHtmlStructure()]);
        return ($this->getState() === true ? $this->export()['output'] : '');
    }

}
