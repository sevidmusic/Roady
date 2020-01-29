<?php

namespace DarlingCms\interfaces\component\Web\Routing;

use DarlingCms\interfaces\component\SwitchableComponent;

interface Request extends SwitchableComponent
{

    public function getGet(): array;

    public function getPost(): array;

    public function getUrl(): string;

}
