<?php

namespace DarlingCms\interfaces\component;

use DarlingCms\interfaces\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\component\Web\Routing\Request;

interface Action extends CoreOutputComponent
{

    public function do(): bool;

    public function wasDone(): bool;

    public function undo(): bool;

    public function wasUndone(): bool;

    public function getCurrentRequest(): Request;

}
