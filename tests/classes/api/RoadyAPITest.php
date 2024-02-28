<?php

namespace Darling\Roady\tests\classes\api;

use \Darling\Roady\classes\api\RoadyAPI;
use \Darling\Roady\tests\RoadyTest;
use \Darling\Roady\tests\interfaces\api\RoadyAPITestTrait;
use \PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoadyAPI::class)]
class RoadyAPITest extends RoadyTest
{

    /**
     * The RoadyAPITestTrait defines
     * common tests for implementations of the
     * Darling\Roady\interfaces\api\RoadyAPI
     * interface.
     *
     * @see RoadyAPITestTrait
     *
     */
    use RoadyAPITestTrait;

    public function setUp(): void
    {
        $this->setRoadyAPITestInstance(
            new RoadyAPI()
        );
    }
}

