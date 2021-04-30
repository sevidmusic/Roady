<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

interface Request extends SwitchableComponentInterface
{

    /**
     * @return array<mixed>
     */
    public function getGet(): array;

    /**
     * @return array<mixed>
     */
    public function getPost(): array;

    /**
     * @return string
     */
    public function getUrl(): string;

}
