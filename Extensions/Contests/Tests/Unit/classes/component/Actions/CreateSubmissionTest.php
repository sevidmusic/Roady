<?php

namespace Extensions\Contests\Tests\Unit\classes\component\Actions;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use Extensions\Contests\core\classes\component\Actions\CreateSubmission;
use Extensions\Contests\Tests\Unit\abstractions\component\Actions\CreateSubmissionTest as AbstractCreateSubmissionTest;

class CreateSubmissionTest extends AbstractCreateSubmissionTest
{
    public function setUp(): void
    {
        $this->setCreateSubmission(
            new CreateSubmission(
                new Storable(
                    'CreateSubmissionName',
                    'CreateSubmissionLocation',
                    'CreateSubmissionContainer'
                ),
                new Switchable(),
                new Positionable(),
                $this->getDevFormFilePath(),
                $this->getMockCrud()
            )
        );
        $this->setCreateSubmissionParentTestInstances();
    }
}
