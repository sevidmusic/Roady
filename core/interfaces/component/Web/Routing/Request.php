<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;

interface Request extends SwitchableComponent
{

    public function getGet(): array;

    public function getPost(): array;

    public function getUrl(): string;

}
