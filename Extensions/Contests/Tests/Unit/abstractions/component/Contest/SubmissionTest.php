<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Contest;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use Extensions\Contests\core\classes\component\Contest\User;
use Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits\SubmissionTestTrait;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;

class SubmissionTest extends CoreOutputComponentTest
{
    use SubmissionTestTrait;

    public function setUp(): void
    {
        $this->setSubmission(
            $this->getMockForAbstractClass(
                '\Extensions\Contests\core\abstractions\component\Contest\Submission',
                [
                    new Storable(
                        'MockSubmissionName',
                        'MockSubmissionLocation',
                        'MockSubmissionContainer'
                    ),
                    new Switchable(),
                    new Positionable(),
                    new User(
                        new Storable(
                            'MockSubmitter',
                            'MockSubmitterLocation',
                            'MockSubmitterContainer'
                        ),
                        'submissiontest@example.com'
                    ),
                    'https://www.youtube.com/watch?v=LBQ2305fLeA&list=PLMlf7rmy7J0fYRGu4nxE74rUhzC9RLjWn&index=173'
                ]
            )
        );
        $this->setSubmissionParentTestInstances();
    }

}
