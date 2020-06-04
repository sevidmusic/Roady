<?php

namespace Extensions\Contests\Tests\Unit\abstractions\component\Contest;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\component\ComponentTest;
use Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits\SubmitterTestTrait;

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
                ]
            )
        );
        $this->setSubmitterParentTestInstances();
    }

}