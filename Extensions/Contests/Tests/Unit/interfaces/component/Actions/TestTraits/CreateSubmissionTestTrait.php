<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits;

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

    public function getCreateSubmission(): CreateSubmission
    {
        return $this->createSubmission;
    }

    public function setCreateSubmission(CreateSubmission $createSubmission): void
    {
        $this->createSubmission = $createSubmission;
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
