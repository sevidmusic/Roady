<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Contest;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use Extensions\Contests\core\abstractions\component\Contest\Submission;
use Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits\SubmissionTestTrait;
use Extensions\Contests\core\classes\component\Contest\Submitter;

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
                    new Submitter(
                        new Storable(
                            'MockSubmitter',
                            'MockSubmitterLocation',
                            'MockSubmitterContainer'
                        )
                    )
                ]
            )
        );
        $this->setSubmissionParentTestInstances();
    }

}
