<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Web\App;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

interface Factory extends Component
{
    public const CONTAINER = 'FACTORIES';

    public function getApp(): App;

    public function getAppDomain(): Request;

}
