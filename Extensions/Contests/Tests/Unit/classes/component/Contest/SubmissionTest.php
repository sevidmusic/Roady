<?php

namespace Extensions\Contests\Tests\Unit\classes\component\Contest;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use Extensions\Contests\core\classes\component\Contest\Submission;
use Extensions\Contests\core\classes\component\Contest\Submitter;
use Extensions\Contests\Tests\Unit\abstractions\component\Contest\SubmissionTest as AbstractSubmissionTest;

class SubmissionTest extends AbstractSubmissionTest
{
    public function setUp(): void
    {
        $this->setSubmission(
            new Submission(
                new Storable(
                    'SubmissionName',
                    'SubmissionLocation',
                    'SubmissionContainer'
                ),
                new Switchable(),
                new Positionable(),
                new Submitter(
                    new Storable(
                        'SubmitterName',
                        'SubmitterLocation',
                        'SubmitterContainer'
                    ),
                    'mocksubmissiontest@example.com'
                ),
                'https://www.youtube.com/watch?v=LBQ2305fLeA&list=PLMlf7rmy7J0fYRGu4nxE74rUhzC9RLjWn&index=173'
            )
        );
        $this->setSubmissionParentTestInstances();
    }
}
