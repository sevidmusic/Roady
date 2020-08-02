<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use Extensions\Contests\core\interfaces\component\Contest\User;
use RuntimeException;

trait UserTestTrait
{

    private $user;

    public function testGetEmailThrowsRuntimeExceptionIfEmailAssignedToEmailPropertyIsNotAValidEmail(): void
    {
        $this->getUser()->import(['email' => 'bad_email']);
        $this->expectException(RuntimeException::class);
        $this->getUser()->getEmail();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function testEmailPropertyIsAssignedAValidEmailPostInstantiation(): void
    {
        $this->assertTrue(
            is_string(
                filter_var(
                    $this->getUser()->export()['email'],
                    FILTER_VALIDATE_EMAIL
                )
            )
        );
    }

    public function testGetEmailReturnsStringThatMatchesStringAssignedToEmailProperty(): void
    {
        $this->assertEquals(
            $this->getUser()->export()['email'],
            $this->getUser()->getEmail()
        );
    }

    protected function setUserParentTestInstances(): void
    {
        $this->setComponent($this->getUser());
        $this->setComponentParentTestInstances();
    }
}
