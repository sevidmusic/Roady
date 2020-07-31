<?php

namespace DarlingDataManagementSystem\interfaces\component\UserInterface;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as CoreOutputComponent;

interface StandardUI extends CoreOutputComponent
{

    public function getTemplatesAssignedToResponses(): array;

    public function getOutputComponentsAssignedToResponses(): array;

}
