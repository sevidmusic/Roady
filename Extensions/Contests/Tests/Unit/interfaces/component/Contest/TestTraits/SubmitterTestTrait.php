<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use Extensions\Contests\core\interfaces\component\Contest\Submitter;
use RuntimeException;

trait SubmitterTestTrait
{

    private $submitter;

    public function testGetEmailThrowsRuntimeExceptionIfEmailAssignedToEmailPropertyIsNotAValidEmail(): void
    {
        $this->getSubmitter()->import(['email' => 'bad_email']);
        $this->expectException(RuntimeException::class);
        $this->getSubmitter()->getEmail();
    }

    public function getSubmitter(): Submitter
    {
        return $this->submitter;
    }

    public function setSubmitter(Submitter $submitter)
    {
        $this->submitter = $submitter;
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
}
