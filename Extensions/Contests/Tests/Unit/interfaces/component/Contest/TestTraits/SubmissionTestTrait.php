<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use Extensions\Contests\core\interfaces\component\Contest\Submission;
use RuntimeException;

trait SubmissionTestTrait
{

    private $submission;

    public function testSubmitterPropertyIsAssignedASubmitterImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'Extensions\Contests\core\interfaces\component\Contest\Submitter',
                class_implements($this->getSubmission()->export()['submitter'])
            )
        );
    }

    public function testGetSubmitterReturnsSameSubmitterImplementationInstanceAssignedToSubmitterProperty(): void
    {
        $this->assertEquals(
            $this->getSubmission()->export()['submitter'],
            $this->getSubmission()->getSubmitter()
        );
    }

    public function test__constructThrowsRuntimeExceptionIfStringSuppliedToPathToSubmittedFileArgumentIsANotAPathToAnExistingFile(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getReflectionUtility()->getClassInstance(
            $this->getSubmission(),
            $this->getReflectionUtility()->generateMockClassMethodArguments(
                $this->getSubmission(),
                '__construct'
            )
        );
    }

    protected function setSubmissionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getSubmission());
        $this->setOutputComponentParentTestInstances();
    }

    public function getSubmission(): Submission
    {
        return $this->submission;
    }

    public function setSubmission(Submission $submission): void
    {
        $this->submission = $submission;
    }

    public function testDateTimeOfSubmissionIsAssignedADateTimeImplementationInstancePostInstantiationWhoseTimestampMatchesExpectedTimestamp(): void
    {
        $expectedDateTime = new \DateTime('now');
        $expectedTimestamp = $expectedDateTime->getTimestamp();
        $actuallDateTimeAssignedToDateTimeOfSubmissionProperty = $this->getSubmission()->export()['dateTimeOfSubmission'];
        $actualTimestampOfDateTimeAssignedToDateTimeOfSubmissionProperty = $actuallDateTimeAssignedToDateTimeOfSubmissionProperty->getTimestamp();
        $this->assertEquals(
            $expectedTimestamp,
            $actualTimestampOfDateTimeAssignedToDateTimeOfSubmissionProperty
        );
    }

    public function testMetaDataPropertyIsAssignedAnEmptyArrayPostInstantiation(): void
    {
        $metaData = $this->getSubmission()->export()['metaData'];
        $this->assertTrue(is_array($metaData));
        $this->assertEmpty($metaData);
    }

    public function testAssignMetaDataAssignsSpecifiedValueToSpecifiedKeyInMetaDataPropertysArray(): void
    {
        $this->getSubmission()->assignMetaData('key', 'value');
        $this->assertEquals(
            $this->getSubmission()->export()['metaData']['key'],
            'value'
        );
    }
}
