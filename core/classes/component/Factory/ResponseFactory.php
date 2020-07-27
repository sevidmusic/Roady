<?php

namespace DarlingCms\classes\component\Factory;

use DarlingCms\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingCms\abstractions\component\Factory\ResponseFactory as CoreResponseFactory;

class ResponseFactory extends CoreResponseFactory implements ResponseFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ResponseFactoryBase class
     * fulfills the requirements of the ResponseFactoryInterface.
     */
}