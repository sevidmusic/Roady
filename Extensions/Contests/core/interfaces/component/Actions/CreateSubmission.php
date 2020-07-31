<?php

namespace Extensions\Contests\core\interfaces\component\Actions;

use DarlingDataManagementSystem\interfaces\component\Action as CoreAction;

interface CreateSubmission extends CoreAction
{

    public function getPathToHtmlForm(): string;

}