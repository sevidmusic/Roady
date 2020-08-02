<?php

namespace Extensions\Contests\core\interfaces\component\Contest;

use DarlingDataManagementSystem\interfaces\component\Component;

interface User extends Component
{

    public function getEmail(): string;
}
