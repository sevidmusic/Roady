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

    public static function setUpBeforeClass(): void
    {
        self::$crud = new ComponentCrud(
            new Storable('StandardUI_TestCrud', 'StandardUI_TestComponents', 'StandardUI_TestCruds'),
            new Switchable(),
            new StorageDriver(
                new Storable('StandardUI_TestStorageDriver', 'StandardUI_TestComponents', 'StandardUI_TestStorageDrivers'),
                new Switchable()
            )
        );
        self::$currentRequest = self::getRandomRequest();
        self::$router = new Router(
            new Storable('StandardUI_TestRouter', 'StandardUI_TestComponents', 'StandardUI_TestRouters'),
            new Switchable(),
            self::$currentRequest,
            self::$crud
        );
        // Create Responses
        self::getRandomResponse();
        //var_dump(self::$crud->readAll('StandardUI_TestComponents', 'StandardUI_TestRequests'));
        // Store Responses, Templates, and Output Components
    }

    private static function getRandomRequest(): Request
    {
        // Create Requests
        $request = new Request(
            new Storable('StandardUI_TestRequest' . strval(rand(1000, 9999)), 'StandardUI_TestComponents', 'StandardUI_TestRequests'),
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
        self::$crud->create($request);
        return $request;
    }

    private static function getRandomResponse(): Response
    {
        $response = new Response(
            new Storable('StandardUI_TestResponse' . strval(rand(1000, 9999)), 'StandardUI_TestComponents', 'StandardUI_TestResponses'),
            new Switchable()
        );
        $response->addRequestStorageInfo(self::$currentRequest);
        for ($i = 0; $i < 100; $i++) {
            $response->addOutputComponentStorageInfo(self::getRandomOutputComponent());
        }
        for ($x = 0; $x < 30; $x++) {
            $response->addTemplateStorageInfo(self::getRandomTemplate());
        }
        self::$crud->create($response);
        return $response;
    }

    private static function getRandomOutputComponent(): OutputComponent
    {
        // Create Create Output Components
        $outputComponent = new OutputComponent(
            new Storable('StandardUI_TestOutputComponent' . strval((rand(1000, 9999))), 'StandardUI_TestComponents', 'StandardUI_TestOutputComponents'),
            new Switchable(),
            new Positionable(self::getRandomPosition())
        );
        $outputComponent->import(['output' => 'Output ' . strval(rand(1000, 9999))]);
        self::$crud->create($outputComponent);
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
            new Storable('StandardUI_TestTemplate' . strval(rand(1000, 9999)), 'StandardUI_TestComponents', 'StandardUI_TestTemplates'),
            new Switchable(),
            new Positionable(self::getRandomPosition())
        );
        $template->addType(self::getRandomOutputComponent());
        self::$crud->create($template);
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
        foreach ($this->getStandardUI()->getTemplatesForCurrentRequest() as $template) {
            var_dump($template->getType());
        }
        $this->assertTrue(true);
        // i.e. implemnts StandardUITemplate interface
        //
    }

    protected function setStandardUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getStandardUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getStandardUI(): StandardUI
    {
        return $this->standardUI;
    }

    public function setStandardUI(StandardUI $standardUI): void
    {
        $this->standardUI = $standardUI;
    }
    // public function testGetTemplatesForCurrentRequestReturnsArrayOfStandardUITemplatesFromEachResponseToCurrentRequest() // i.e. is assinged to at least one of the Responses to the current request

    // public function testGetTemplatesForCurrentRequestsReturnsArrayIndexedByStringsTheEvaluateToNumbers() |  since indexes will be strings, use PHPs is_numeric() function to test each index @see https://www.php.net/manual/en/function.is-numeric.php

}
