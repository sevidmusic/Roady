<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Web\App;

interface Factory extends Component
{
    public const CONTAINER = 'FACTORIES';

    public function getApp(): App;
    /**
     * @todo Implement the following:
     *
     * getApp(): App
     *
     * getAppDomain(): Request
     *
     */
}
