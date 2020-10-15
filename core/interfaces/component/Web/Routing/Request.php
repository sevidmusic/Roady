<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

interface Request extends SwitchableComponentInterface
{

    public function getGet(): array;

    public function getPost(): array;

    public function getUrl(): string;

}
