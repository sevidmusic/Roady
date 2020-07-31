<?php

namespace Extensions\Contests\core\interfaces\component\Contest;

use DarlingDataManagementSystem\interfaces\component\Component;

interface Submitter extends Component
{

    public function getEmail(): string;
}
