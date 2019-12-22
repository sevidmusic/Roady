<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Identifiable;
use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\IdentifiableTestTrait;

class IdentifiableTest extends TestCase
{
    use IdentifiableTestTrait;
    /**
     * @var Identifiable
     */
    protected $identifiable;

    public function setUp(): void
    {
        $this->identifiable = new Identifiable('MockName');
    }

}

