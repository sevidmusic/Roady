<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Contest;

use DarlingDataManagementSystem\classes\primary\Storable;
use Extensions\Contests\core\abstractions\component\Contest\User;
use Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits\UserTestTrait;
use UnitTests\abstractions\component\ComponentTest;

class UserTest extends ComponentTest
{
    use UserTestTrait;

    public function setUp(): void
    {
        $this->setUser(
            $this->getMockForAbstractClass(
                User::class,
                [
                    new Storable(
                        'MockUserName',
                        'MockUserLocation',
                        'MockUserContainer'
                    ),
                    'mockusertest@example.com'
                ]
            )
        );
        $this->setUserParentTestInstances();
    }

}
