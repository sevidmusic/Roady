<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Request;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission;
use RuntimeException;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as CoreStandardStorageDriver;

trait CreateSubmissionTestTrait
{

    private $createSubmission;

    public function test__constructThrowsRuntimeExceptionIfStringSuppliedToPathToHtmlFormArgumentIsANotAPathToAnExistingFile(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getReflectionUtility()->getClassInstance(
            $this->getCreateSubmission(),
            $this->getReflectionUtility()->generateMockClassMethodArguments(
                $this->getCreateSubmission(),
                '__construct'
            )
        );
    }

    public function getCreateSubmission(): CreateSubmission
    {
        return $this->createSubmission;
    }

    public function setCreateSubmission(CreateSubmission $createSubmission): void
    {
        $this->createSubmission = $createSubmission;
    }

    public function testPathAssignedToPathToHtmlFormPropertyPointsToAnExistingFile(): void
    {
        $this->assertTrue(
            file_exists(
                $this->getCreateSubmission()->export()['pathToHtmlForm']
            )
        );
    }

    public function testPathAssignedToPathToHtmlFormPropertyDoesNotPointToADirectory(): void
    {
        $this->assertFalse(
            is_dir(
                $this->getCreateSubmission()->export()['pathToHtmlForm']
            )
        );
    }

    public function testGetOutputReturnsContentsOfFileLocatedAtPathAssignedToPathToHtmlFormPropertyIfCreateSubmissionsUniqueIdDoesNotExistInCurrentRequestsPOSTData(): void
    {
        $expectedOutput = file_get_contents($this->getDevFormFilePath());
        if (!in_array($this->getCreateSubmission()->getUniqueId(), $this->getCreateSubmission()->getCurrentRequest()->getPost())) {
            $this->assertEquals(
                $expectedOutput,
                $this->getCreateSubmission()->getOutput()
            );
        }
    }
/*
    public function testDoCreatesSubmissionFromPostDataIfCreateSubmissionInstancesUniqueIdIsSetInCurrentRequestsPostDataAndSumitterNameAndSubmitterEmailAndPathToSubmittedFileKeysExistInRequestsPostData(): void
    {
        $this->getCreateSubmission()->getCurrentRequest()->import(
            [
                'post' => $this->mockPostArrayForRequestExpectedByDo()
            ]
        );
        $this->verifyMockPostArrayAssignedToCurrentRequestIsConfiguredAsExpectedByDoMethod();
        $this->getCreateSubmission()->do();
        // check if submission was stored and that values match expected...
    }
 */
    private function verifyMockPostArrayAssignedToCurrentRequestIsConfiguredAsExpectedByDoMethod(): void
    {
        $postDataKeys = array_keys($this->getCreateSubmission()->getCurrentRequest()->getPost());
        if(
            !in_array($this->getCreateSubmission()->getUniqueId(), $this->getCreateSubmission()->getCurrentRequest()->getPost())
            ||
            !in_array('submitterName', $postDataKeys)
            ||
            !in_array('submitterEmail', $postDataKeys)
            ||
            !in_array('pathToSubmittedFile', $postDataKeys)
        ) {
            throw new \RuntimeException('Mock Post Array for Request Expected by CreateSubmission::do() method is not configured correctly for tests, tests will fail till this is fixed.');
        }
    }
    private function mockPostArrayForRequestExpectedByDo(): array
    {
        return [
            'submitterName' => 'Foo',
            'submitterEmail' => 'foo@bar.com',
            'pathToSubmittedFile' => str_replace(
                'Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits',
                'devData/devImage.jpeg',
                __DIR__
            ),
            'CreateSubmissionUniqueId' => $this->getCreateSubmission()->getUniqueId()
        ];
    }

    protected function getDevFormFilePath(): string
    {
        return str_replace(
            [
                'Extensions/Contests/Tests/Unit/interfaces/component/Actions/TestTraits',
            ],
            '',
            __DIR__ . 'Apps/dcmsDev/htmlContent/devForm.html'
        );
    }

    protected function setCreateSubmissionParentTestInstances(): void
    {
        $this->setAction($this->getCreateSubmission());
        $this->setActionParentTestInstances();
    }

    public function testComponentCrudPropertyIsAssignedAComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingCms\interfaces\component\Crud\ComponentCrud',
                class_implements($this->getCreateSubmission()->export()['componentCrud'])
            )
        );
    }

    public function getMockCrud(): ComponentCrud
    {
        return new CoreComponentCrud(
            new Storable('t','t','t'),
            new Switchable(),
            new CoreStandardStorageDriver(
                new Storable('t','t','t'),
                new Switchable()
            )
        );
    }
}
