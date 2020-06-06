<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as CoreStandardStorageDriver;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission;
use RuntimeException;

trait CreateSubmissionTestTrait
{

    private $createSubmission;

    public function testGetPathToHtmlFormThrowsRuntimeExceptionIfPathAssignedToPathToHtmlFormPropertyIsNotAPathToAnExistingFile(): void
    {
        $this->getCreateSubmission()->import(['pathToHtmlForm' => '__badPathDIDDFE34589jf89d__']);
        $this->expectException(RuntimeException::class);
        $this->getCreateSubmission()->getPathToHtmlForm();
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
            new Storable('MockCrud', 'TEMP', 'Cruds'),
            new Switchable(),
            new CoreStandardStorageDriver(
                new Storable('MockStandardStorageDriver', 'TEMP', 'StorageDrivers'),
                new Switchable()
            )
        );
    }

    protected function setCreateSubmissionParentTestInstances(): void
    {
        $this->setAction($this->getCreateSubmission());
        $this->setActionParentTestInstances();
    }
    /*
        public function testDoCreatesSubmissionFromPostDataIfCreateSubmissionInstancesUniqueIdIsSetInCurrentRequestsPostDataAndSubmitterNameAndSubmitterEmailAndPathToSubmittedFileKeysExistInRequestsPostData(): void
        {
            $this->getCreateSubmission()->getCurrentRequest()->import(
                [
                    'post' => $this->mockPostArrayForRequestExpectedByDo()
                ]
            );
            $this->verifyMockPostArrayAssignedToCurrentRequestIsConfiguredAsExpectedByDoMethod();
            $mockExpectedSubmission = $this->mockCreateSubmissionFromPostData(
                $this->getCreateSubmission()->getCurrentRequest()
            );
            $this->getCreateSubmission()->do();
            $this->getMockCrud()->create($mockExpectedSubmission);
            $this->assertFalse(
                empty(
                    $this->getMockCrud()->readAll(
                        $mockExpectedSubmission->getLocation(),
                        $mockExpectedSubmission->getContainer()
                    )
                )
            );
            // check if submission was stored and that values match expected...
        }
        */
    /*
        private function mockPostArrayForRequestExpectedByDo(): array
        {
            return [
                'submitterName' => 'SubmitterName',
                'submitterContainer' => 'SubmitterContainer',
                'submitterEmail' => 'submitteremail@example.com',
                'pathToSubmittedFile' => str_replace(
                    'Extensions/Contests/Tests/Unit/interfaces/component/Actions/TestTraits',
                    'devData/devImage.jpeg',
                    __DIR__
                ),
                'CreateSubmissionUniqueId' => $this->getCreateSubmission()->getUniqueId(),
                'submissionName' => 'SubmissionName',
                'submissionContainer' => 'SubmissionContainer'
            ];
        }

        private function verifyMockPostArrayAssignedToCurrentRequestIsConfiguredAsExpectedByDoMethod(): void
        {
            $postDataKeys = array_keys($this->getCreateSubmission()->getCurrentRequest()->getPost());
            if (
                !in_array($this->getCreateSubmission()->getUniqueId(), $this->getCreateSubmission()->getCurrentRequest()->getPost())
                ||
                !in_array('CreateSubmissionUniqueId', $postDataKeys)
                ||
                !in_array('submitterName', $postDataKeys)
                ||
                !in_array('submitterContainer', $postDataKeys)
                ||
                !in_array('submitterEmail', $postDataKeys)
                ||
                !in_array('pathToSubmittedFile', $postDataKeys)
                ||
                !in_array('submissionName', $postDataKeys)
                ||
                !in_array('submissionContainer', $postDataKeys)
            ) {
                throw new RuntimeException('Mock Post Array for Request Expected by CreateSubmission::do() method is not configured correctly for tests, tests will fail till this is fixed.');
            }
        }

        private function mockCreateSubmissionFromPostData(Request $request): Submission
        {
            var_dump($request->getPost()['submitterEmail']);
            return new ContestSubmission(
                new Storable(
                    $request->getPost()['submissionName'],
                    App::deriveNameLocationFromRequest($request),
                    $request->getPost()['submissionContainer']
                ),
                new Switchable(),
                new Positionable(),
                new Submitter(
                    new Storable(
                        $request->getPost()['submitterName'],
                        App::deriveNameLocationFromRequest($request),
                        $request->getPost()['submitterContainer']
                    ),
                    $request->getPost()['submitterEmail']
                ),
                $request->getPost()['pathToSubmittedFile']
            );
        }
    */
}
