<?php

namespace DarlingCms\interfaces\component;

use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\component\OutputComponent as CoreOutputComponent;

interface Action extends CoreOutputComponent
{

    public function do(Request $currentRequest): bool;

    public function isDone(): bool;

    public function undo(): bool;

    public function wasUndone();

}
