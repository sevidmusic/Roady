<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

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
