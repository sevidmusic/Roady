<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

interface Action extends CoreOutputComponent
{

    public function do(): bool;

    public function wasDone(): bool;

    public function undo(): bool;

    public function wasUndone(): bool;

    public function getCurrentRequest(): Request;

}
