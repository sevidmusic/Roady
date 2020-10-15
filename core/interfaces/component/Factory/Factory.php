<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App as AppInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

interface Factory extends ComponentInterface
{
    public const CONTAINER = 'FACTORIES';

    public function getApp(): AppInterface;

    public function getAppDomain(): RequestInterface;

}
