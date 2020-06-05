<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use Extensions\Contests\core\interfaces\component\Contest\Submitter;
use RuntimeException;

trait SubmitterTestTrait
{

    private $submitter;

    public function test__constructThrowsRuntimeExceptionIfSuppliedEmailIsNotAValidEmail(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getReflectionUtility()->getClassInstance(
            $this->getSubmitter(),
            $this->getReflectionUtility()->generateMockClassMethodArguments(
                $this->getSubmitter(),
                '__construct'
            )
        );
    }

    public function testEmailPropertyIsAssignedAValidEmailPostInstantiation(): void
    {
        $this->assertTrue(
            is_string(
                filter_var(
                    $this->getSubmitter()->export()['email'],
                    FILTER_VALIDATE_EMAIL
                )
            )
        );
    }

    public function testGetEmailReturnsStringThatMatchesStringAssignedToEmailProperty(): void
    {
        $this->assertEquals(
            $this->getSubmitter()->export()['email'],
            $this->getSubmitter()->getEmail()
        );
    }

    protected function setSubmitterParentTestInstances(): void
    {
        $this->setComponent($this->getSubmitter());
        $this->setComponentParentTestInstances();
    }

    public function getSubmitter(): Submitter
    {
        return $this->submitter;
    }

    public function setSubmitter(Submitter $submitter)
    {
        $this->submitter = $submitter;
    }
}
