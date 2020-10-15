<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

interface Action extends OutputComponentInterface
{

    public function do(): bool;

    public function wasDone(): bool;

    public function undo(): bool;

    public function wasUndone(): bool;

    public function getCurrentRequest(): RequestInterface;

}
