<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use DateTime;
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

    public function getSubmission(): Submission
    {
        return $this->submission;
    }

    public function setSubmission(Submission $submission): void
    {
        $this->submission = $submission;
    }

    public function testGetSubmitterReturnsSameSubmitterImplementationInstanceAssignedToSubmitterProperty(): void
    {
        $this->assertEquals(
            $this->getSubmission()->export()['submitter'],
            $this->getSubmission()->getSubmitter()
        );
    }

    public function testGetPathToSubmittedFileThrowsARuntimeExceptionIfPathToSubmittedFilePropertyIsNotAssignedAPathToAnExistingFile(): void
    {
        $this->getSubmission()->import(['pathToSubmittedFile' => 'badFilePath24754h8g8fdh8f9gy983498fd7gs98dfhg5987dyf9g8hdfg89dfg789fgfd889h']);
        $this->expectException(RuntimeException::class);
        $this->getSubmission()->getPathToSubmittedFile();
    }

    public function testDateTimeOfSubmissionIsAssignedADateTimeImplementationInstancePostInstantiationWhoseTimestampMatchesExpectedTimestamp(): void
    {
        $expectedDateTime = new DateTime('now');
        $expectedTimestamp = $expectedDateTime->getTimestamp();
        $actualDateTimeAssignedToDateTimeOfSubmissionProperty = $this->getSubmission()->export()['dateTimeOfSubmission'];
        $actualTimestampOfDateTimeAssignedToDateTimeOfSubmissionProperty = $actualDateTimeAssignedToDateTimeOfSubmissionProperty->getTimestamp();
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

    public function testGetOutputReturnsANonEmptyString(): void
    {
        $this->assertNotEmpty($this->getSubmission()->getOutput());
    }

    protected function setSubmissionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getSubmission());
        $this->setOutputComponentParentTestInstances();
    }

}
