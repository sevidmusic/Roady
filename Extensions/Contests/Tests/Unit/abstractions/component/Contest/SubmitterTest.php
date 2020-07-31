<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Contest;

use DarlingDataManagementSystem\classes\primary\Storable;
use Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits\SubmitterTestTrait;
use UnitTests\abstractions\component\ComponentTest;

class SubmitterTest extends ComponentTest
{
    use SubmitterTestTrait;

    public function setUp(): void
    {
        $this->setSubmitter(
            $this->getMockForAbstractClass(
                '\Extensions\Contests\core\abstractions\component\Contest\Submitter',
                [
                    new Storable(
                        'MockSubmitterName',
                        'MockSubmitterLocation',
                        'MockSubmitterContainer'
                    ),
                    'mocksubmittertest@example.com'
                ]
            )
        );
        $this->setSubmitterParentTestInstances();
    }

}
