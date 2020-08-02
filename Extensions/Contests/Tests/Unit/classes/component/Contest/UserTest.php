<?php

namespace Extensions\Contests\Tests\Unit\classes\component\Contest;


use DarlingDataManagementSystem\classes\primary\Storable;
use Extensions\Contests\core\classes\component\Contest\User;
use Extensions\Contests\Tests\Unit\abstractions\component\Contest\UserTest as AbstractUserTest;

class UserTest extends AbstractUserTest
{
    public function setUp(): void
    {
        $this->setUser(
            new User(
                new Storable(
                    'UserName',
                    'UserLocation',
                    'UserContainer'
                ),
                'usertest@example.com'
            )
        );
        $this->setUserParentTestInstances();
    }
}
