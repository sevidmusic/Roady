<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingCms\abstractions\component\UserInterface\StandardUI;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;

class StandardUITest extends CoreOutputComponentTest
{
    use StandardUITestTrait;

    private static $crud;
    private static $router;
    private static $outputComponents = [];
    private static $currentRequest;

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
        self::getRandomRequest();
        var_dump(self::$crud->readAll('StandardUI_TestComponents', 'StandardUI_TestRequests'));
        // Store Responses, Templates, and Output Components
    }

    private static function getRandomResponse(): Response
    {
        $response = new Response(
            new Storable('StandardUI_TestResponse' . strval(rand(1000,9999)),'StandardUI_TestComponents','StandardUI_TestResponses'),
            new Switchable()
        );
        $response->addRequestStorageInfo(self::$currentRequest);
        self::$crud->create($response);
        return $response;
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

    private static function getRandomOutputComponent(): OutputComponent
    {
        // Create Create Output Components
        $outputComponent = new OutputComponent(
            new Storable('StandardUI_TestOutputComponent' . strval((rand(1000, 9999))), 'StandardUI_TestComponents', 'StandardUI_TestOutputComponents'),
            new Switchable(),
            new Positionable(self::getRandomPosition())
        );
        $outputComponent->import(['output' => 'Output ' . strval(rand(1000, 9999))]);
        self::$crud->create($output);
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
        self::$crud->create($template);
        return $template;
    }

    public function setUp(): void
    {
        $this->setStandardUI(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\UserInterface\StandardUI',
                [
                    new Storable(
                        'MockStandardUIName',
                        'MockStandardUILocation',
                        'MockStandardUIContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setStandardUIParentTestInstances();
    }

}
