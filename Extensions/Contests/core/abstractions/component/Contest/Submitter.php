<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use Extensions\Contests\core\interfaces\component\Contest\Submitter as SubmitterInterface;

abstract class Submitter extends Component implements SubmitterInterface
{

    private $email = 'someemail@example.com';

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
