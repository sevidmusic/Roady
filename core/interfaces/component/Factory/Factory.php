<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

interface Factory extends ComponentInterface
{
    public const CONTAINER = 'FACTORIES';

    public function getApp(): AppInterface;

    public function getAppDomain(): RequestInterface;

}
