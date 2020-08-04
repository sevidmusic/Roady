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
                'Extensions\Contests\core\interfaces\component\Contest\User',
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

    public function testGetUrlThrowsARuntimeExceptionIfUrlPropertyIsNotAssignedAProperlyFormattedUrl(): void
    {
        $this->getSubmission()->import(['url' => 'bad_url' . $this->getSubmission()->getUniqueId()]);
        $this->expectException(RuntimeException::class);
        $this->getSubmission()->getUrl();
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

    public function testVoterEmailsPropertyIsAssignedAnEmptyArrayPostInstantiation(): void
    {
        $this->assertTrue(is_array($this->getSubmission()->export()['voterEmails']));
    }

    protected function setSubmissionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getSubmission());
        $this->setOutputComponentParentTestInstances();
    }

}
