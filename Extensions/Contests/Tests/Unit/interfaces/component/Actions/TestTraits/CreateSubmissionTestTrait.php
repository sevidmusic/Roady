<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as CoreStandardStorageDriver;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Web\Routing\Request;
use Extensions\Contests\core\classes\component\Contest\Submission as ContestSubmission;
use Extensions\Contests\core\classes\component\Contest\Submitter;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission;
use Extensions\Contests\core\interfaces\component\Contest\Submission;
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

    public function testPathAssignedToTestInstancesPathToHtmlFormPropertyPointsToAnExistingFile(): void
    {
        $this->assertTrue(
            file_exists(
                $this->getCreateSubmission()->export()['pathToHtmlForm']
            )
        );
    }

    public function testPathAssignedToTestInstancesPathToHtmlFormPropertyDoesNotPointToADirectory(): void
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

    private function prepareCurrentRequestToMockExpectedPostRequest(): void
    {
        $this->getCreateSubmission()->getCurrentRequest()->import(
            [
                'post' => $this->mockPostArrayForRequestExpectedByDo()
            ]
        );
        $this->verifyMockPostArrayAssignedToCurrentRequestIsConfiguredAsExpectedByDoMethod();

    }

    private function mockPostAndGetExpectedSubmission(): Submission
    {
        $this->prepareCurrentRequestToMockExpectedPostRequest();
        return $this->mockCreateSubmissionFromPostData(
            $this->getCreateSubmission()->getCurrentRequest()
        );

    }

    public function testDoCreatesAndStoresSubmissionFromExpectedPostDataWhoseDataMatchesExpectedSubmissionExceptForUniqueIds(): void
    {
        $mockExpectedSubmission = $this->mockPostAndGetExpectedSubmission();
        $this->getCreateSubmission()->do();
        foreach($this->getStoredSubmissions($mockExpectedSubmission) as $storedSubmission) {
            if($mockExpectedSubmission->getName() === $storedSubmission->getName()) {
                $this->pathToSubmittedFilesMatch($mockExpectedSubmission, $storedSubmission);
                $this->dateTimeOfSubmissionTimestampsMatch($mockExpectedSubmission, $storedSubmission);
                $this->submitterNamesMatch($mockExpectedSubmission, $storedSubmission);
                $this->submitterEmailsMatch($mockExpectedSubmission, $storedSubmission);
                $this->submissionMetaDataMatches($mockExpectedSubmission, $storedSubmission);
            }
        }
    }

    private function submissionMetaDataMatches(Submission $expectedSubmission, Submission $actualSubmission): void {
        $this->assertEquals(
            $expectedSubmission->export()['metaData'],
            $actualSubmission->export()['metaData']
        );
    }

    private function submitterNamesMatch(Submission $expectedSubmission, Submission $actualSubmission): void {
        $this->assertEquals(
            $expectedSubmission->export()['submitter']->getName(),
            $actualSubmission->export()['submitter']->getName()
        );
    }

    private function submitterEmailsMatch(Submission $expectedSubmission, Submission $actualSubmission): void {
        $this->assertEquals(
            $expectedSubmission->export()['submitter']->getEmail(),
            $actualSubmission->export()['submitter']->getEmail()
        );
    }

    private function pathToSubmittedFilesMatch(Submission $expectedSubmission, Submission $actualSubmission): void {
        $this->assertEquals(
            $expectedSubmission->getPathToSubmittedFile(),
            $actualSubmission->getPathToSubmittedFile()
        );
    }

    private function dateTimeOfSubmissionTimestampsMatch(Submission $expectedSubmission, Submission $actualSubmission): void {
        $this->assertEquals(
            $expectedSubmission->export()['dateTimeOfSubmission']->getTimestamp(),
            $actualSubmission->export()['dateTimeOfSubmission']->getTimestamp()
        );
    }

    private function getStoredSubmissions(Submission $expectedSubmission): array
    {
        return $this->getMockCrud()->readAll(
            $expectedSubmission->getLocation(),
            $expectedSubmission->getContainer()
        );
    }

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
        //var_dump($request->getPost()['submitterEmail']);
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
}
