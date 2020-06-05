<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Actions;

use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\Contests\Tests\Unit\interfaces\component\Actions\TestTraits\CreateSubmissionTestTrait;
use UnitTests\abstractions\component\ActionTest as CoreActionTest;

class CreateSubmissionTest extends CoreActionTest
{
    use CreateSubmissionTestTrait;

    public function setUp(): void
    {
        $this->setCreateSubmission(
            $this->getMockForAbstractClass(
                '\Extensions\Contests\core\abstractions\component\Actions\CreateSubmission',
                [
                    new Storable(
                        'MockCreateSubmissionName',
                        'MockCreateSubmissionLocation',
                        'MockCreateSubmissionContainer'
                    ),
                    new Switchable(),
                    new Positionable(),
                    $this->getDevFormFilePath(),
                    $this->getMockCrud()
                ]
            )
        );
        $this->setCreateSubmissionParentTestInstances();
    }

}
