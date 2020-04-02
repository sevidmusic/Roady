<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\UserInterface\StandardUI;

trait StandardUITestTrait
{

    private static $crud;
    private static $router;
    private static $outputComponents = [];
    private static $currentRequest;
    private $standardUI;
    private static $suiTestComponentsLocation = 'StandardUITestComponentLocation';
    private static $suiTestStorageDriverContainer = 'StandardUITestStorageDriverContainer';
    private static $suiTestCrudContainer = 'StandardUITestCrudContainer';
    private static $suiTestRequestContainer = 'StandardUITestRequestContainer';
    private static $suiTestResponseContainer = 'StandardUITestResponseContainer';
    private static $suiTestOutputComponentContainer = 'StandardUITestOutputComponentContainer';
    private static $suiTestTemplateContainer = 'StandardUITestTemplateContainer';
    private static $suiTestRouterContainer = 'StandardUITestRouterContainer';

    protected static function staticGetStandardUITestComponentLocation(): string
    {
        return self::$suiTestComponentsLocation;
    }

    protected function getStandardUITestComponentLocation(): string
    {
        return self::$suiTestComponentsLocation;
    }

    public static function setUpBeforeClass(): void
    {
        self::$crud = new ComponentCrud(
            new Storable('StandardUI_TestCrud', self::staticGetStandardUITestComponentLocation(), self::$suiTestCrudContainer),
            new Switchable(),
            new StorageDriver(
                new Storable('StandardUITestStorageDriver', self::staticGetStandardUITestComponentLocation(), self::$suiTestStorageDriverContainer),
                new Switchable()
            )
        );
        self::$currentRequest = self::getRandomRequest();
        self::$router = new Router(
            new Storable('StandardUITestRouter', self::staticGetStandardUITestComponentLocation(), self::$suiTestRouterContainer),
            new Switchable(),
            self::$currentRequest,
            self::staticGetCrud()
        );
        // Create Responses
        self::getRandomResponse();
    }

    private static function getRandomRequest(): Request
    {
        // Create Requests
        $request = new Request(
            new Storable('StandardUITestRequest' . strval(rand(1000, 9999)), self::staticGetStandardUITestComponentLocation(), self::$suiTestRequestContainer),
            new Switchable()
        );
        switch (rand(0, 3)) {
            case 3:
                $request->import(['url' => 'https://foo.bar/']);
                break;
            case 2:
                $request->import(['url' => 'https://foo.bar/baz' . strval(rand(1000, 9999)) . '.php']);
                break;
            case 1:
                $request->import(['url' => 'https://foo.bar/baz' . strval(rand(1000, 9999)) . '.php?bazzer&foo=bar' . strval(rand(1000, 9999))]);
                break;
            default:
                $request->import(['url' => 'https://foo.bar/baz.php?' . strval(rand(1000, 9999))]);
                break;
        }
        self::staticGetCrud()->create($request);
        return $request;
    }

    private static function staticGetCrud(): ComponentCrud
    {
        return self::$crud;
    }

    private static function getRandomResponse(): Response
    {
        $response = new Response(
            new Storable('StandardUITestResponse' . strval(rand(1000, 9999)), self::staticGetStandardUITestComponentLocation(), self::$suiTestResponseContainer),
            new Switchable()
        );
        $response->addRequestStorageInfo(self::$currentRequest);
        for ($i = 0; $i < 100; $i++) {
            $response->addOutputComponentStorageInfo(self::getRandomOutputComponent());
        }
        for ($x = 0; $x < 30; $x++) {
            $response->addTemplateStorageInfo(self::getRandomTemplate());
        }
        self::staticGetCrud()->create($response);
        return $response;
    }

    private static function getRandomOutputComponent(): OutputComponent
    {
        // Create Create Output Components
        $outputComponent = new OutputComponent(
            new Storable('StandardUITestOutputComponent' . strval((rand(1000, 9999))), self::staticGetStandardUITestComponentLocation(), self::$suiTestOutputComponentContainer),
            new Switchable(),
            new Positionable(self::getRandomPosition())
        );
        $outputComponent->import(['output' => 'Output ' . strval(rand(1000, 9999))]);
        self::staticGetCrud()->create($outputComponent);
        return $outputComponent;
    }

    private static function getRandomPosition(): float
    {
        /**
         * We want some Positionable Components to be assigned same position
         * so we can test that positions are incremented appropriately when
         * two Positionable components used by the StandardUI have same
         * position, so rand() is assigned a small range to insure some
         * positions are repeated. If you change the range later, keep
         * it small, i.e. less or equal to number of Positionable components
         * being used in tests.
         */
        return (rand(0, 5) / 100);
    }

    private static function getRandomTemplate(): StandardUITemplate
    {
        $template = new StandardUITemplate(
            new Storable('StandardUITestTemplate' . strval(rand(1000, 9999)), self::staticGetStandardUITestComponentLocation(), self::$suiTestTemplateContainer),
            new Switchable(),
            new Positionable(self::getRandomPosition())
        );
        $template->addType(self::getRandomOutputComponent());
        self::staticGetCrud()->create($template);
        return $template;
    }

    public function getCurrentRequest(): Request
    {
        return self::$currentRequest;
    }

    public function getCrud(): ComponentCrud
    {
        return self::$crud;
    }

    public function testGetTemplatesForCurrentRequestReturnsArrayOfStandardUITemplates(): void
    {
        foreach ($this->getStandardUI()->getTemplatesForCurrentRequest($this->getStandardUITestComponentLocation(), self::$suiTestTemplateContainer) as $template) {
            $this->assertTrue(in_array('DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate', class_implements($template)));
        }
    }

    public function testGetTemplatesForCurrentRequestReturnsArrayOfAllTemplatesAssignedToAllResponsesToCurrentRequest(){
        $this->assertEquals(1,1);
        var_dump('ct_culprit_1_tgta_callToGetStoredTemplatesForCurrentRequestViaCrud',count($this->getStoredTemplatesForCurrentRequestViaCrud()));
//        var_dump('ct_culprit_tgtb',count($this->getStandardUI()->getTemplatesForCurrentRequest($this->getStandardUITestComponentLocation(), 'StandardUITestResponses')));
//        $this->assertEquals(
//            $this->getStoredTemplatesForCurrentRequestViaCrud(),
//            $this->getStandardUI()->getTemplatesForCurrentRequest($this->getStandardUITestComponentLocation(), 'StandardUITestResponses')
//        );
    }

    private function getStoredResponsesThatRespondToCurrentRequestViaCrud(): array
    {

        $storedResponses = $this->getCrud()->readAll($this->getStandardUITestComponentLocation(), 'StandardUITestResponses');
        foreach($storedResponses as $storedResponse) {
            if($storedResponse->respondsToRequest($this->getCurrentRequest(), $this->getCrud()) === true) {
                array_push($storedResponses, $storedResponse);
            }
        }
        var_dump('ct_culprit_2_gsrtrtcrvc_FromGetStoredResponsesThatRespondToCurrentRequestViaCrud',count($storedResponses));
        return $storedResponses;
    }

    public function getStoredTemplatesForCurrentRequestViaCrud(): array
    {
        $storedTemplates = [];
        foreach($this->getStoredResponsesThatRespondToCurrentRequestViaCrud() as $response) {
            foreach($response->getTemplateStorageInfo() as $templateStorable)
                {
                    $storedTemplate = $this->getCrud()->read($templateStorable);
                    if(isset($storedTemplates[$storedTemplate->getPosition()]))
                    {
                        $storedTemplate->increasePosition();
                    }
                    $storedTemplates[$storedTemplate->getPosition()] = $storedTemplate;

                }
        }
        var_dump('ct_culprit_1_gstfcrvc_callFromWithinGetStiredTemplatesForCurrentRequestViaCrud_MethodUsesGetStoredResponsesThatRespondToCurrentRequestViaCrud',count($storedTemplates));
        return $storedTemplates;
    }

    public function getStandardUI(): StandardUI
    {
        return $this->standardUI;
    }

    public function setStandardUI(StandardUI $standardUI): void
    {
        $this->standardUI = $standardUI;
    }

    protected function setStandardUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getStandardUI());
        $this->setOutputComponentParentTestInstances();
    }
    // public function testGetTemplatesForCurrentRequestReturnsArrayOfStandardUITemplatesFromEachResponseToCurrentRequest() // i.e. is assigned to at least one of the Responses to the current request

    // public function testGetTemplatesForCurrentRequestsReturnsArrayIndexedByStringsTheEvaluateToNumbers() |  since indexes will be strings, use PHPs is_numeric() function to test each index @see https://www.php.net/manual/en/function.is-numeric.php

}
