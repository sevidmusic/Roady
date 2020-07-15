<?php

namespace DarlingCms\classes\component\Factory;

use DarlingCms\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingCms\abstractions\component\Factory\RequestFactory as CoreRequestFactory;

class RequestFactory extends CoreRequestFactory implements RequestFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the RequestFactoryBase class
     * fulfills the requirements of the RequestFactoryInterface.
     */
}