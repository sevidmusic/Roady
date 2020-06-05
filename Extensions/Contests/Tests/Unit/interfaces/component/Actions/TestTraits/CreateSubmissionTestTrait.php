<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Request;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission;
use RuntimeException;

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

    public function getMockRequest(): Request
    {
        return new \DarlingCms\classes\component\Web\Routing\Request(
            new Storable(
                'MockRequest',
                'TEMP',
                'Mocks'
            ),
            new Switchable(),
        );
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

    public function testGetOutputReturnsContentsOfFileLocatedAtPathAssignedToPathToHtmlFormPropertyIfCreateSubmissionsUniqueIdDoesNotExistInRequestsPOSTData(): void
    {
        $expectedOutput = file_get_contents($this->getDevFormFilePath());
        $mockReqest = $this->getMockRequest();
        if(!in_array($this->getCreateSubmission()->getUniqueId(), $mockReqest->getPost())) {
            var_dump($this->getCreateSubmission()->getOutput());
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

    protected function setCreateSubmissionParentTestInstances(): void
    {
        $this->setAction($this->getCreateSubmission());
        $this->setActionParentTestInstances();
    }

}
