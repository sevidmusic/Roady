<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component;

interface Factory extends Component
{
    public const CONTAINER = 'FACTORIES';

    /**
     * @todo Implement the following:
     *
     * getApp(): App
     *
     * getAppDomain(): Request
     *
     */
}
