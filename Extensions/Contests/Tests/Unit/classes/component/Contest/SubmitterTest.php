<?php

namespace Extensions\Contests\Tests\Unit\classes\component\Contest;


use DarlingCms\classes\primary\Storable;
use Extensions\Contests\Tests\Unit\abstractions\component\Contest\SubmitterTest as AbstractSubmitterTest;
use Extensions\Contests\core\classes\component\Contest\Submitter;

class SubmitterTest extends AbstractSubmitterTest
{
    public function setUp(): void
    {
        $this->setSubmitter(
            new Submitter(
                new Storable(
                    'SubmitterName',
                    'SubmitterLocation',
                    'SubmitterContainer'
                ),
            )
        );
        $this->setSubmitterParentTestInstances();
    }
}